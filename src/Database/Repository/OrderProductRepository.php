<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\OrderProduct;
use AvoRed\Framework\Database\Contracts\OrderProductModelInterface;

class OrderProductRepository implements OrderProductModelInterface
{
    /**
     * Create OrderProduct Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\OrderProduct $orderProduct
     */
    public function create(array $data): OrderProduct
    {
        return OrderProduct::create($data);
    }

    /**
     * Find OrderProduct Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\OrderProduct $orderProduct
     */
    public function find(int $id): OrderProduct
    {
        return OrderProduct::find($id);
    }

    /**
     * Delete OrderProduct Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return OrderProduct::destroy($id);
    }

    /**
     * Get all the categories from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $orderProducts
     */
    public function all() : Collection
    {
        return OrderProduct::all();
    }
}
