<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Language;
use AvoRed\Framework\Database\Contracts\LanguageModelInterface;

class LanguageRepository implements LanguageModelInterface
{
    /**
     * Create Language Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Language $language
     */
    public function create(array $data): Language
    {
        return Language::create($data);
    }

    /**
     * get all languages available for this store.
     * @return \Illuminate\Database\Eloquent\Collection $languages
     */
    public function all() : Collection
    {
        return Language::all();
    }
}
