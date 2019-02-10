<?php

namespace AvoRed\Framework\System\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use AvoRed\Framework\Models\Contracts\LanguageInterface;

class LanguageMiddleware
{
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\LanguageRepository
     */
    protected $repository;

    /**
     * Construct to setup Repository
     *
     */
    public function __construct(LanguageInterface $repository)
    {
        $this->repository = $repository;
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
        if (Session::has('multi_language_enabled')) {
            $additionalLanguages = $this->repository->getAdditionalLanguages();
            $defaultLanguage = $this->repository->getDefault();
            $isMultiLanguage = $additionalLanguages->count() > 0 ? true : false;

            Session::put('additionalLanguages', $additionalLanguages);
            Session::put('defaultLanguage', $defaultLanguage);
            Session::put('isMultiLanguage', $isMultiLanguage);
            Session::put('multi_language_enabled', true);
        } else {
            Session::put('additionalLanguages', []);
            Session::put('defaultLanguage', null);
            Session::put('isMultiLanguage', false);
            Session::put('multi_language_enabled', false);
        }
        return $next($request);
    }
}
