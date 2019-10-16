<?php

namespace AvoRed\Framework\Order\Observers;

use AvoRed\Framework\Database\Contracts\ConfigurationModelInterface;
use AvoRed\Framework\Database\Models\Order;
use AvoRed\Framework\Widget\TotalOrder;

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
