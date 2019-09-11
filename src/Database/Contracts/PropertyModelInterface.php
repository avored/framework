<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Property;

interface PropertyModelInterface
{
    /**
     * Create Property Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Property $property
     */
    public function create(array $data) : Property;

    /**
     * Find Property Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Property $property
     */
    public function find(int $id) : Property;

    /**
     * Delete Property Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;

    /**
     * Get All Property from the database.
     * @return \Illuminate\Database\Eloquent\Collection $properties
     */
    public function all() : Collection;

    /**
     * Get All Property from the database.
     * @return \Illuminate\Database\Eloquent\Collection $properties
     */
    public function allPropertyToUseInProduct(): Collection;
}
