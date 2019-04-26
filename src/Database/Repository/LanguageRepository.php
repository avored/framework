<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Language;
use AvoRed\Framework\Database\Contracts\LanguageModelInterface;
use Illuminate\Database\Eloquent\Collection;

class LanguageRepository implements LanguageModelInterface
{
    /**
     * Create Language Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Language $role
     */
    public function create(array $data): Language
    {
        return Language::create($data);
    }

    /**
     * find roles for the users
     * @return \Illuminate\Database\Eloquent\Collection $roles
     */
    public function all() : Collection
    {
        return Language::all();
    }
}
