<?php

namespace AvoRed\Framework\Models\Contracts;

interface OrderInterface
{
    /**
     * Find an Order of a given Id
     *
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id);

    /**
     * Order Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();

    /**
     * All Orders Collection
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();
}
