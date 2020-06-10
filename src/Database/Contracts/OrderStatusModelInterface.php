<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\OrderStatus;

interface OrderStatusModelInterface extends BaseInterface
{
    /**
     * Find Default OrderStatus Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\OrderStatus $orderStatus
     */
    public function findDefault() : OrderStatus;
}
