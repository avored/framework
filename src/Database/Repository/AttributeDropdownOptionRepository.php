<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\AttributeDropdownOption;
use AvoRed\Framework\Database\Contracts\AttributeDropdownOptionModelInterface;

class AttributeDropdownOptionRepository extends BaseRepository implements AttributeDropdownOptionModelInterface
{

    /**
     * @var AttributeDropdownOption $model
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
     * Construct for the Attribute dropdown option Repository
     */
    public function __construct()
    {
        $this->model = new AttributeDropdownOption();
    }

    /**
     * Get the model for the repository
     * @return Attribute 
     */
    public function model(): AttributeDropdownOption
    {
        return $this->model;
    }
}