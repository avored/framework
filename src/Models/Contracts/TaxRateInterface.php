<?php

namespace AvoRed\Framework\Models\Contracts;

interface TaxRateInterface
{
    /**
     * Find a TaxRate by given Id which returns TaxRate Model
     *
     * @param $id
     * @return \AvoRed\Framework\Models\TaxRate
     */
    public function find($id);

    /**
     * Find an All TaxRates which returns Eloquent Collection
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * TaxRate Collection with Limit which returns paginate class
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10);

    /**
     * TaxRate Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();

    /**
     * Create a TaxRate
     *
     * @param array $data
     * @return \AvoRed\Framework\Models\TaxRate
     */
    public function create($data);
}
