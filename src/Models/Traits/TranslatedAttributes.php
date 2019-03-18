<?php
namespace AvoRed\Framework\Models\Traits;

use Illuminate\Support\Facades\Session;

trait TranslatedAttributes
{
    /**
     * Get the Attribute of an model
     * @param string $key
     * @return mixed
     */
    public function getAttribute($key, $translated = false)
    {
        if (false === $translated) {
            return parent::getAttribute($key);
        }
        
        $defaultLanguage = Session::get('default_language');
        $languageId = request()->get('language_id', $defaultLanguage->id);

        if (in_array($key, $this->getTranslatedAttributes())
            && $defaultLanguage->id != $languageId
        ) {
            $translatedModel = $this->translations()
                ->whereLanguageId($languageId)
                ->first();
            if ($translatedModel === null) {
                return null;
            }
            return $translatedModel->attributes[$key];
        }
        
        return parent::getAttribute($key);
    }

    /**
     * Get translated attributes for the existing model
     * @rerurn mixed $translatedAttrbutes
     */
    public function getTranslatedAttributes()
    {
        if (!isset($this->translatedAttributes)) {
            return [];
        }

        return $this->translatedAttributes;
    }

    /**
     * Get translated attributes for the existing model
     * @rerurn mixed $translatedAttrbutes
     */
    public function getTranslatedForeignKey()
    {
        if (!isset($this->translatedForeignKey)) {
            return null;
        }

        return $this->translatedForeignKey;
    }
}
