<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Attribute;
use AvoRed\Framework\Database\Contracts\AttributeModelInterface;

class AttributeRepository extends BaseRepository implements AttributeModelInterface
{
    /**
     * @var Attribute $model
     */
    protected $model;

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
