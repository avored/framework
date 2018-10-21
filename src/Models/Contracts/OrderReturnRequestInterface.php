<?php

namespace AvoRed\Framework\Models\Contracts;

interface OrderReturnRequestInterface
{
    /**
     * Find an Order Return Request of a given Id
     *
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id);

    /**
     * Order Return Request Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();

    /**
     * Create an Order Return Request
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create($data);

    /**
     * All Order Return Request Collection
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();
}
