<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Contracts\PropertyInterface;
use AvoRed\Framework\Models\Database\Property;

class PropertyRepository implements PropertyInterface
{
    /**
     * Find an Property by given Id
     *
     * @param $id
     * @return \AvoRed\Framework\Models\Database\Property
     */
    public function find($id)
    {
        return Property::find($id);
    }

    /**
     * Find an Property collection by given an array of Ids
     *
     * @param array $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findMany($ids)
    {
        return Property::whereIn('id', $ids)->get();
    }

    /**
     * Product Property Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Property::query();
    }

    /**
     * Create an Property an Return an Property Instance
     *
     * @param array $data
     * @return \AvoRed\Framework\Models\Database\Property
     */
    public function create($data)
    {
        return Property::create($data);
    }
}
