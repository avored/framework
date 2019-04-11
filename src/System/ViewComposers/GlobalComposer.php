<?php

namespace AvoRed\Framework\System\ViewComposers;

use Illuminate\View\View;
use AvoRed\Framework\Models\Contracts\LanguageInterface;
use Illuminate\Support\Facades\Session;

class GlobalComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        if (Session::has('multi_language_enabled')) {
            $languages = Session::get('languages');
            $defaultLanguage = Session::get('default_language');
            $langId = request()->get('language_id', $defaultLanguage->id);
            $isDefaultLang = ($defaultLanguage->id == $langId) ? true : false;
        }
        $view->withDefaultLanguage($defaultLanguage)
            ->withLanguages($languages)
            ->withIsDefaultLang($isDefaultLang);
    }
}
