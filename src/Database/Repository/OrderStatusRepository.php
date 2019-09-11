<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\OrderStatus;
use AvoRed\Framework\Database\Contracts\OrderStatusModelInterface;

class OrderStatusRepository implements OrderStatusModelInterface
{
    /**
     * Create OrderStatus Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\OrderStatus $orderStatus
     */
    public function create(array $data): OrderStatus
    {
        return OrderStatus::create($data);
    }

    /**
     * Find OrderStatus Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\OrderStatus $orderStatus
     */
    public function find(int $id): OrderStatus
    {
        return OrderStatus::find($id);
    }

    /**
     * Find OrderStatus Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\OrderStatus $orderStatus
     */
    public function findDefault(): OrderStatus
    {
        return OrderStatus::whereIsDefault(1)->first();
    }

    /**
     * Delete OrderStatus Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return OrderStatus::destroy($id);
    }

    /**
     * Get all the categories from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $categories
     */
    public function all() : Collection
    {
        return OrderStatus::all();
    }
}
