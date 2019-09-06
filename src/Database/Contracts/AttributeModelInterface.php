<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Attribute;

interface AttributeModelInterface
{
    /**
     * Create Attribute Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Attribute $attribute
     */
    public function create(array $data) : Attribute;

    /**
     * Find Attribute Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Attribute $attribute
     */
    public function find(int $id) : Attribute;

    /**
     * Delete Attribute Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;

    /**
     * Get All Attribute from the database.
     * @return \Illuminate\Database\Eloquent\Collection $attributes
     */
    public function all() : Collection;
}
