<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Attribute;
use AvoRed\Framework\Database\Contracts\AttributeModelInterface;

class AttributeRepository implements AttributeModelInterface
{
    /**
     * Create Attribute Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Attribute $attribute
     */
    public function create(array $data): Attribute
    {
        return Attribute::create($data);
    }

    /**
     * Find Attribute Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Attribute $attribute
     */
    public function find(int $id): Attribute
    {
        return Attribute::find($id);
    }

    /**
     * Delete Attribute Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return Attribute::destroy($id);
    }

    /**
     * Get all the attributes from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $attributes
     */
    public function all() : Collection
    {
        return Attribute::all();
    }
}
