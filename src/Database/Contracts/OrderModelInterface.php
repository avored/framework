<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderModelInterface extends BaseInterface
{
    /**
     * Find Orders of a given customer Id.
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection $customerOrders
     */
    public function findByCustomerId(int $id) : LengthAwarePaginator;

    /**
     * Get current month total orders
     * @return int $totalOrders
     */
    public function getCurrentMonthTotalOrder() : int;

    /**
     * Get current month total revenue
     * @return int $totalOrders
     */
    public function getCurrentMonthTotalRevenue() : float;
}
