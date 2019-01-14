<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Contracts\TaxGroupInterface;
use AvoRed\Framework\Models\Database\TaxGroup;

class TaxGroupRepository implements TaxGroupInterface
{
    /**
     * Find a TaxGroup by given Id
     *
     * @param $id
     * @return \AvoRed\Framework\Models\TaxGroup
     */
    public function find($id)
    {
        return TaxGroup::find($id);
    }

    /**
     * Get all TaxGroup
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return TaxGroup::all();
    }

    /**
     * Paginate TaxGroup
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return TaxGroup::paginate($noOfItem);
    }

    /**
     * Get a TaxGroup Query Builder Object
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return TaxGroup::query();
    }

    /**
     * Create a TaxGroup Record
     *
     * @return \AvoRed\Framework\Models\TaxGroup
     */
    public function create($data)
    {
        return TaxGroup::create($data);
    }
}
