<?php

namespace AvoRed\Framework\System\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;
use AvoRed\Framework\Models\Contracts\SiteCurrencyInterface;
use AvoRed\Framework\Cart\Facade as Cart;
use AvoRed\Framework\Models\Contracts\ProductInterface;

class SiteCurrencyMiddleware
{
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\ConfigurationRepository
     */
    protected $repository;

    /**
     *
     * @var \AvoRed\Framework\Models\Repository\SiteCurrencyRepository $curRep
     */
    protected $curRep;

    /**
     *
     * @var \AvoRed\Framework\Models\Repository\ProductRepository $productRepository
     */
    protected $productRepository;

    /**
     * Construct to setup Repository
     *
     */
    public function __construct(
        ConfigurationInterface $rep,
        SiteCurrencyInterface $curRep,
        ProductInterface $productRepository
    ) {
        $this->repository = $rep;
        $this->curRep = $curRep;
        $this->productRepository = $productRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Remove session from user if current currency do not exist
        if(null !== Session::get('currency_code')) {
            $currency = $this->curRep->findByCode(Session::get('currency_code'));
            if(is_null($currency)) {
                Session::remove('currency_code');
                Session::remove('currency_symbol');
            }
        }

        if (null === $request->get('currency_code') && null !== Session::get('currency_code')) {
            return $next($request);
        }

        $currencyCode = $request->get('currency_code');

        if (null === $currencyCode) {
            $configCurrency = $this->repository->getValueByKey('general_site_currency');
            $siteCurrencyModel = $this->curRep->find($configCurrency);

            $currencyCode = $siteCurrencyModel->code;
            $currencySymbol = $siteCurrencyModel->symbol;
        } else {
            $siteCurrencyModel = $this->curRep->findByCode($currencyCode);
            $currencySymbol = $siteCurrencyModel->symbol;
        }

        $sessionCode = Session::get('currency_code', $currencyCode);

        // If cart has any product then re calculate the price and save it into db
        if (null !== $sessionCode && $sessionCode !== $currencyCode) {
            $model = $this->curRep->findByCode($currencyCode);

            $products = Cart::all();

            if ($products->count() > 0) {
                foreach ($products as $product) {
                    // Re calculate and set the price

                    $productModel = $this->productRepository->findBySlug($product->slug());
                    $productAttributes = $productModel->getAttributes();
                    $qty = $product->qty();

                    $newPrice = $productAttributes['price'] * $model->conversion_rate;
                    $product->price($newPrice);

                    $isTaxEnabled = $this->repository->getValueByKey('tax_enabled');

                    if ($isTaxEnabled && $productModel->is_taxable) {
                        $percentage = $this->repository->getValueByKey('tax_percentage');
                        $taxAmount = ($percentage * $productAttributes['price'] / 100) * $qty;

                        $newTax = $taxAmount * $model->conversion_rate;
                        $product->tax($newTax);
                    }
                    // Re calculate and set the price

                    // Re calculate and set the line total
                    $newPLineTotla = $newPrice * $qty * $model->conversion_rate;
                    $product->lineTotal($newPLineTotla);
                }
            }
        }

        Session::put('currency_code', $currencyCode);
        Session::put('currency_symbol', $currencySymbol);

        return $next($request);
    }
}
