<?php

namespace AvoRed\Framework\System\ViewComposers;

use Illuminate\View\View;
use AvoRed\Framework\Models\Contracts\LanguageInterface;

class GlobalComposer
{

    /**
     * Language Repository
     * @var \AvoRed\Framework\Models\Repository\LanguageRepository
     */
    protected $languageRepository;

    /**
     * Global Composer Construct to setup Language Repository
     * @var \AvoRed\Framework\Models\Contracts\LanguageInterface $repository
     */
    public function __construct(LanguageInterface $repository)
    {
        $this->languageRepository = $repository;
    }
    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $additionalLanguages = $this->languageRepository->getAdditionalLanguages();
        $defaultLanguage = $this->languageRepository->getDefault();
        $isMultiLanguage = $additionalLanguages->count() > 0 ? true : false;

        $view->withAdditionalLanguages($additionalLanguages)
            ->withIsMutliLanguage($isMultiLanguage)
            ->withDefaultLanguage($defaultLanguage);
    }
}
