<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Property;
use AvoRed\Framework\Database\Contracts\PropertyModelInterface;
use Illuminate\Database\Eloquent\Collection;

class PropertyRepository implements PropertyModelInterface
{
    /**
     * Create Property Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Property $property
     */
    public function create(array $data): Property
    {
        return Property::create($data);
    }

    /**
     * Find Property Resource into a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Property $property
     */
    public function find(int $id): Property
    {
        return Property::find($id);
    }

    /**
     * Delete Property Resource from a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Property $property
     */
    public function delete(int $id): bool
    {
        return Property::destroy($id);
    }

    /**
     * Get all the properties from the connected database
     * @return \Illuminate\Database\Eloquent\Collection $properties
     */
    public function all() : Collection
    {
        return Property::all();
    }
}
