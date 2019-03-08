<?php

namespace AvoRed\Framework\System\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use AvoRed\Framework\Models\Contracts\LanguageInterface;
use Illuminate\Support\Collection;

class LanguageMiddleware
{
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\LanguageRepository
     */
    protected $languageRepository;

    /**
     * Construct to setup Repository
     *
     */
    public function __construct(LanguageInterface $languageRepository)
    {
        $this->languageRepository = $languageRepository;
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
        if (!Session::has('language_setup')) {
            $languages = $this->languageRepository->all();
            $defaultLanguage = $this->languageRepository->getDefault();
            Session::put('languages', $languages);
            Session::put('default_language', $defaultLanguage);
            
            if ($languages->count() > 1) {
                Session::put('multi_language_enabled', true);   
            } else {
                Session::put('multi_language_enabled', false);
            }
            Session::put('language_setup', true);
        }
        return $next($request);
    }
}
