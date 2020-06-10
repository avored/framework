<?php

namespace AvoRed\Framework\Order\Observers;

use AvoRed\Framework\Database\Models\Order;

class OrderObserver
{
    /**
     * Handle the Order "created" event
     * @param \AvoRed\Framework\Database\Models\Order $order
     * @return void
     */
    public function created(Order $order)
    {
        //
    }
}
