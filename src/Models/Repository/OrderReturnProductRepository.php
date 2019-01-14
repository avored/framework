<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Contracts\OrderReturnProductInterface;
use AvoRed\Framework\Models\Database\OrderReturnProduct;

class OrderReturnProductRepository implements OrderReturnProductInterface
{
    /**
     * Find an Order Return Product by a given id of a Order
     *
     * @param integer $id
     * @return \AvoRed\Framework\Models\Database\OrderReturnProduct
     */
    public function find($id)
    {
        return OrderReturnProduct::find($id);
    }

    /**
     * Create an Order Return Product by a given id of a Order
     *
     * @param array $id
     * @return \AvoRed\Framework\Models\Database\OrderReturnProduct
     */
    public function create($data)
    {
        return OrderReturnProduct::create($data);
    }

    /**
     * Get an Order Return Product Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function query()
    {
        return OrderReturnProduct::query();
    }

    /**
     * Get an Order Return Product Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return OrderReturnProduct::all();
    }
}
