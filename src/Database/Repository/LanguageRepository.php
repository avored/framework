<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Language;
use AvoRed\Framework\Database\Contracts\LanguageModelInterface;

class LanguageRepository extends BaseRepository implements LanguageModelInterface
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
     * Find Language Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Language $language
     */
    public function find(int $id): Language
    {
        return Language::find($id);
    }

    /**
     * Delete Language Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return Language::destroy($id);
    }

    /**
     * Get all the languages from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $languages
     */
    public function all() : Collection
    {
        return Language::all();
    }
}
