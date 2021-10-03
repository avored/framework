<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Property;
use AvoRed\Framework\Database\Contracts\PropertyModelInterface;
use AvoRed\Framework\Database\Traits\FilterTrait;

class PropertyRepository extends BaseRepository implements PropertyModelInterface
{
    use FilterTrait;

    /**
     * Filterable Fields
     * @var array $filterType
     */
    protected $filterFields = [
        'name',
        'slug'
    ];


    /**
     * @var Property $model
     */
    protected $model;

    /**
     * Construct for the Property Repository
     */
    public function __construct()
    {
        $this->model = new Property();
    }

    /**
     * Get the model for the repository
     * @return Property
     */
    public function model(): Property
    {
        return $this->model;
    }

}
