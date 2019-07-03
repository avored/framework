<?php
namespace AvoRed\Framework\Support\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use AvoRed\Framework\Database\Contracts\CurrencyModelInterface;

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
        $currencies = $this->getActiveCurrencies();

        //dd($currencies);
        return $next($request);
    }

    /**
     *
     *
     */
    public function getActiveCurrencies()
    {
        $currencies = $this->currencyRepository->all();
    }
}
