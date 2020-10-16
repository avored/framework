<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Language;
use AvoRed\Framework\Database\Contracts\LanguageModelInterface;

class LanguageRepository extends BaseRepository implements LanguageModelInterface
{
    /**
     * @var Language $model
     */
    protected $model;

    /**
     * Construct for the Language Repository
     */
    public function __construct()
    {
        $this->model = new Language();
    }

    /**
     * Get the model for the repository
     * @return Language 
     */
    public function model(): Language
    {
        return $this->model;
    }
}
