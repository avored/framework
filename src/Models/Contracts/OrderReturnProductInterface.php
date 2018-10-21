<?php

namespace AvoRed\Framework\Models\Contracts;

interface OrderReturnProductInterface
{
    /**
     * Find an Order Return Product of a given Id
     *
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id);

    /**
     * Find an Order Return Product of a given Id
     *
     * @param array $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create($data);

    /**
     * Order Return Product Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();

    /**
     * All Order Return Product Collection
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();
}
