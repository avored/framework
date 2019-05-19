<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Attribute;
use AvoRed\Framework\Database\Contracts\AttributeModelInterface;
use Illuminate\Database\Eloquent\Collection;

class AttributeRepository implements AttributeModelInterface
{
    /**
     * Create Attribute Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Attribute $property
     */
    public function create(array $data): Attribute
    {
        return Attribute::create($data);
    }

    /**
     * Find Attribute Resource into a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Attribute $property
     */
    public function find(int $id): Attribute
    {
        return Attribute::find($id);
    }

    /**
     * Delete Attribute Resource from a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Attribute $property
     */
    public function delete(int $id): bool
    {
        return Attribute::destroy($id);
    }

    /**
     * Get all the properties from the connected database
     * @return \Illuminate\Database\Eloquent\Collection $properties
     */
    public function all() : Collection
    {
        return Attribute::all();
    }
}
