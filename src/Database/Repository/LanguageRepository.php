<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Language;
use AvoRed\Framework\Database\Contracts\LanguageModelInterface;
use AvoRed\Framework\Database\Traits\FilterTrait;

class LanguageRepository extends BaseRepository implements LanguageModelInterface
{
    use FilterTrait;

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
     * Filterable Fields
     * @var array $filterType
     */
    protected $filterFields = [
        'name',
        'code'
    ];
    /**
     * Get the model for the repository
     * @return Language 
     */
    public function model(): Language
    {
        return $this->model;
    }

    /**
     * Make All Language Status to Disabled
     * 
     * @return bool
     */
    public function makeAllDisabled(): bool
    {
        return $this->query()
            ->where('is_default', 1)
            ->update(['is_default' => 0]);
    }
}
