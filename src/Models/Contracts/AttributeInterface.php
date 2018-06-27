<?php

namespace AvoRed\Framework\Models\Contracts;

interface AttributeInterface
{
    /**
     * Find an Attribute by given Id which returns Attribute Model
     *
     * @param integer $id
     * @return \AvoRed\Framework\Models\Database\Attribute
     */
    public function find($id);

    /**
     * Find an Attribute by given Id which returns Attribute Model
     *
     * @param array $ids
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findMany($id);

    /**
     * Find an All Admin Users which returns Eloquent Collection
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Attribute Collection with Limit which returns paginate class
     *
     * @param integer $noOfItem
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10);

    /**
     * Attribute Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();

    /**
     * Create an Attribute
     *
     * @param array $data
     * @return \AvoRed\Framework\Models\Database\Attribute
     */
    public function create($data);
}
