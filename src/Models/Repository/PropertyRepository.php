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
     * Product Property Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Property::query();
    }
}
