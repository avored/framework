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
            $additionalLanguages = Session::get('additionalLanguages');
            $defaultLanguage = Session::get('defaultLanguage');
            $isMultiLanguage = Session::get('isMultiLanguage');
        }

        $view->withAdditionalLanguages($additionalLanguages)
            ->withIsMutliLanguage($isMultiLanguage)
            ->withDefaultLanguage($defaultLanguage);
    }
}
