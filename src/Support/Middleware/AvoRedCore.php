<?php

namespace AvoRed\Framework\Support\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use AvoRed\Framework\Database\Contracts\CurrencyModelInterface;

class AvoRedCore
{
    /**
     * @var \AvoRed\Framework\Database\Repository\CurrencyRepository
     */
    protected $currencyRepository;

    /**
     * AvoRed Core Middleware Construct.
     * @param \AvoRed\Framework\Database\Contracts\CurrencyModelInterface $currencyRepository
     */
    public function __construct(CurrencyModelInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->setDefaultCurrency();

        return $next($request);
    }

    /**
     * Set the Default Currency for the Application.
     * @return void
     */
    public function setDefaultCurrency()
    {
        if (! Session::has('default_currency')) {
            $currency = $this->currencyRepository->getDefault();
            Session::put('default_currency', $currency);
        }
        if (! Session::has('default_currency_symbol')) {
            $currency = $this->currencyRepository->getDefault();
            Session::put('default_currency_symbol', $currency->symbol);
        }
    }
}
