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
        }
        $view->withDefaultLanguage($defaultLanguage)
            ->withLanguages($languages);
    }
}
