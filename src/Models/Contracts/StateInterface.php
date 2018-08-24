<?php

namespace AvoRed\Framework\Models\Contracts;

interface StateInterface
{
    /**
     * Find a State by given Id which returns State Model
     *
     * @param $id
     * @return \AvoRed\Framework\Models\State
     */
    public function find($id);

    /**
     * Find an All States which returns Eloquent Collection
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * State Collection with Limit which returns paginate class
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10);

    /**
     * State Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();

    /**
     * Create a State
     *
     * @param array $data
     * @return \AvoRed\Framework\Models\State
     */
    public function create($data);
}
