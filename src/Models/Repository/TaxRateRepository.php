<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Contracts\TaxRateInterface;
use AvoRed\Framework\Models\Database\TaxRate;

class TaxRateRepository implements TaxRateInterface
{
    /**
     * Find a TaxRate by given Id
     *
     * @param $id
     * @return \AvoRed\Framework\Models\TaxRate
     */
    public function find($id)
    {
        return TaxRate::find($id);
    }

    /**
     * Get all TaxRate
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return TaxRate::all();
    }

    /**
     * Paginate TaxRate
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return TaxRate::paginate($noOfItem);
    }

    /**
     * Get a TaxRate Query Builder Object
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return TaxRate::query();
    }

    /**
     * Create a TaxRate Record
     *
     * @return \AvoRed\Framework\Models\TaxRate
     */
    public function create($data)
    {
        return TaxRate::create($data);
    }
}
