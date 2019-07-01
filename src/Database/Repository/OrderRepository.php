<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Order;
use AvoRed\Framework\Database\Contracts\OrderModelInterface;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository implements OrderModelInterface
{
    /**
     * Create Order Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Order $order
     */
    public function create(array $data): Order
    {
        return Order::create($data);
    }

    /**
     * Find Order Resource into a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Order $order
     */
    public function find(int $id): Order
    {
        return Order::find($id);
    }

    /**
     * Find Orders of a given user Id
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection $userOrders
     */
    public function findByUserId(int $id) : Collection
    {
        return Order::whereUserId($id)->get();
    }

    /**
     * Delete Order Resource from a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Order $order
     */
    public function delete(int $id): bool
    {
        return Order::destroy($id);
    }

    /**
     * Get all the orders from the connected database
     * @return \Illuminate\Database\Eloquent\Collection $orders
     */
    public function all() : Collection
    {
        return Order::all();
    }
}
