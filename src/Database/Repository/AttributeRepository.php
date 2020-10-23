<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Attribute;
use AvoRed\Framework\Database\Contracts\AttributeModelInterface;
use AvoRed\Framework\Database\Traits\FilterTrait;

class AttributeRepository extends BaseRepository implements AttributeModelInterface
{
    use FilterTrait;

    /**
     * @var Attribute $model
     */
    protected $model;

    /**
     * Filterable Fields
     * @var array $filterType
     */
    protected $filterFields = [
        'name',
        'slug',
    ];

    /**
     * Construct for the Attribute Repository
     */
    public function __construct()
    {
        $this->model = new Attribute();
    }

    /**
     * Get the model for the repository
     * @return Attribute 
     */
    public function model(): Attribute
    {
        return $this->model;
    }
}
