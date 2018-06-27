<?php

namespace AvoRed\Framework\Models\Contracts;

interface OrderHistoryInterface
{
    /**
     * Create an Order History
     *
     * @param array $data
     * @return \AvoRed\Framework\Models\Database\Order History
     */
    public function create($data);
}
