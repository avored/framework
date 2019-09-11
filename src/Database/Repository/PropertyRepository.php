<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Property;
use AvoRed\Framework\Database\Contracts\PropertyModelInterface;

class PropertyRepository implements PropertyModelInterface
{
    /**
     * Create Property Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Property $property
     */
    public function create(array $data): Property
    {
        return Property::create($data);
    }

    /**
     * Find Property Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Property $property
     */
    public function find(int $id): Property
    {
        return Property::find($id);
    }

    /**
     * Delete Property Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return Property::destroy($id);
    }

    /**
     * Get all the properties from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $properties
     */
    public function all() : Collection
    {
        return Property::all();
    }

    /**
     * Get all the properties from the connected database which is used in all products.
     * @return \Illuminate\Database\Eloquent\Collection $properties
     */
    public function allPropertyToUseInProduct() : Collection
    {
        return Property::whereUseForAllProducts(1)->get();
    }
}
