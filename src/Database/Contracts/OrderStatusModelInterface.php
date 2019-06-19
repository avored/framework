<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\OrderStatus;
use Illuminate\Database\Eloquent\Collection;

interface OrderStatusModelInterface
{
    /**
     * Create OrderStatus Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\OrderStatus $orderStatus
     */
    public function create(array $data) : OrderStatus;

    /**
     * Find OrderStatus Resource into a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\OrderStatus $orderStatus
     */
    public function find(int $id) : OrderStatus;

    /**
     * Find Default OrderStatus Resource into a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\OrderStatus $orderStatus
     */
    public function findDefault() : OrderStatus;

    /**
     * Delete OrderStatus Resource from a database
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool;

    /**
     * Get All OrderStatus from the database
     * @return \Illuminate\Database\Eloquent\Collection $orderStatuses
     */
    public function all() : Collection;
}
