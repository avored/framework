<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\Order;
use Illuminate\Database\Eloquent\Collection;

interface OrderModelInterface
{
    /**
     * Create Order Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Order $order
     */
    public function create(array $data) : Order;

    /**
     * Find Order Resource into a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Order $order
     */
    public function find(int $id) : Order;

    /**
     * Find Orders of a given user Id
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection $userOrders
     */
    public function findByUserId(int $id) : Collection;

    /**
     * Delete Order Resource from a database
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool;

    /**
     * Get All Order from the database
     * @return \Illuminate\Database\Eloquent\Collection $orders
     */
    public function all() : Collection;
}
