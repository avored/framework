<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\OrderProduct;
use Illuminate\Database\Eloquent\Collection;

interface OrderProductModelInterface
{
    /**
     * Create OrderProduct Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\OrderProduct $orderProduct
     */
    public function create(array $data) : OrderProduct;

    /**
     * Find OrderProduct Resource into a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\OrderProduct $orderProduct
     */
    public function find(int $id) : OrderProduct;

    /**
     * Delete OrderProduct Resource from a database
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;

    /**
     * Get All OrderProduct from the database
     * @return \Illuminate\Database\Eloquent\Collection $orderProducts
     */
    public function all() : Collection;
}
