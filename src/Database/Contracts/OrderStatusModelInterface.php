<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\OrderStatus;

interface OrderStatusModelInterface extends BaseInterface
{
    /**
     * Find Default OrderStatus Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\OrderStatus $orderStatus
     */
    public function findDefault(): OrderStatus;

    /**
     * Update existing is default status to zero so new one can be marked
     *
     * @return bool
     */
    public function updateDefaultOrderStatusToNull(): bool;
}
