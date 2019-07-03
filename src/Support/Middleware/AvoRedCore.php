<?php
namespace AvoRed\Framework\Support\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use AvoRed\Framework\Database\Contracts\CurrencyModelInterface;
use Illuminate\Support\Facades\Session;

class AvoRedCore
{
    /**
     * @var \AvoRed\Framework\Database\Repository\CurrencyRepository
     */
    protected $currencyRepository;
    
    /**
     * AvoRed Core Middleware Construct
     * @param \AvoRed\Framework\Database\Repository\CurrencyRepository
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
     * Set the Default Currency for the Application
     * @return void
     */
    public function setDefaultCurrency()
    {
        if (!Session::has('default_currency')) {
            $currency = $this->currencyRepository->all()->first();
            Session::put('default_currency', $currency);
        }
    }
}
