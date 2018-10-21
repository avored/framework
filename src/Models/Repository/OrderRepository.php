<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Contracts\OrderInterface;
use AvoRed\Framework\Models\Database\Order;

class OrderRepository implements OrderInterface
{
    /**
     * Find an Order by a given id of a Order
     *
     * @param integer $id
     * @return \AvoRed\Framework\Models\Database\Order
     */
    public function find($id)
    {
        return Order::find($id);
    }

    /**
     * Get an Order Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function query()
    {
        return Order::query();
    }

    /**
     * Get an Order Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Order::all();
    }
}
