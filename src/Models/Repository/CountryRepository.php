<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Contracts\CountryInterface;
use AvoRed\Framework\Models\Database\Country;

class CountryRepository implements CountryInterface
{
    /**
     * Find a Country by given Id
     *
     * @param $id
     * @return \AvoRed\Framework\Models\Country
     */
    public function find($id)
    {
        return Country::find($id);
    }

    /**
    * Get all Country
    *
    * @return \Illuminate\Database\Eloquent\Collection
    */
    public function all()
    {
        return Country::all();
    }

    /**
     * Paginate Country
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return Country::paginate($noOfItem);
    }

    /**
     * Get a Country Query Builder Object
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Country::query();
    }

    /**
     * Create a Country Record
     *
     * @return \AvoRed\Framework\Models\Country
     */
    public function create($data)
    {
        return Country::create($data);
    }
}
