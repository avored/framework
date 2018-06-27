<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Database\OrderHistory;
use AvoRed\Framework\Models\Contracts\OrderHistoryInterface;

class OrderHistoryRepository implements OrderHistoryInterface
{
    /**
     * Create an Order History Record
     *
     * @return \AvoRed\Framework\Models\Database\OrderHistory
     */
    public function create($data)
    {
        return OrderHistory::create($data);
    }
}
