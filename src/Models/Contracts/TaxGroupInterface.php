<?php

namespace AvoRed\Framework\Models\Contracts;

interface TaxGroupInterface
{
    /**
     * Find a TaxGroup by given Id which returns TaxGroup Model
     *
     * @param $id
     * @return \AvoRed\Framework\Models\TaxGroup
     */
    public function find($id);

    /**
     * Find an All TaxGroups which returns Eloquent Collection
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * TaxGroup Collection with Limit which returns paginate class
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10);

    /**
     * TaxGroup Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();

    /**
     * Create a TaxGroup
     *
     * @param array $data
     * @return \AvoRed\Framework\Models\TaxGroup
     */
    public function create($data);
}
