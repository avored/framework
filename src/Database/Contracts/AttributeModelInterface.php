<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\Attribute;
use Illuminate\Database\Eloquent\Collection;

interface AttributeModelInterface
{
    /**
     * Create Attribute Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Attribute $property
     */
    public function create(array $data) : Attribute;

    /**
     * Find Attribute Resource into a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Attribute $property
     */
    public function find(int $id) : Attribute;

    /**
     * Delete Attribute Resource from a database
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool;

    /**
     * Get All Attribute from the database
     * @return \Illuminate\Database\Eloquent\Collection $properties
     */
    public function all() : Collection;
}
