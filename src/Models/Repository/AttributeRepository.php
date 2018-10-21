<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Database\Attribute;
use AvoRed\Framework\Models\Contracts\AttributeInterface;

class AttributeRepository implements AttributeInterface
{
    /**
     * Find an Attributeby given Id
     *
     * @param $id
     * @return \AvoRed\Framework\Models\Database\Attribute
     */
    public function find($id)
    {
        return Attribute::find($id);
    }

    /**
     * Find an Attributeby given Id
     *
     * @param $id
     * @return \AvoRed\Framework\Models\Database\Attribute
     */
    public function findMany($ids)
    {
        return Attribute::whereIn('id', $ids)->get();
    }

    /**
     * Find an Attribute by given Id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Attribute::all();
    }

    /**
     * Paginate Attribute
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return Attribute::paginate($noOfItem);
    }

    /**
     * Find an Attribute Query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Attribute::query();
    }

    /**
     * Find an Attribute Query
     *
     * @return \AvoRed\Framework\Models\Database\Attribute
     */
    public function create($data)
    {
        return Attribute::create($data);
    }
}
