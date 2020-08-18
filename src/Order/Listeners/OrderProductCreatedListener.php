<?php

namespace AvoRed\Framework\Order\Listeners;

use AvoRed\Framework\Order\Events\OrderProductCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderProductCreatedListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderProductCreated $event)
    {
        /** @todo what to do if there is an variable product?? */
        $orderProduct = $event->orderProduct;
        $product = $orderProduct->product;
        
        if ($product->track_stock) {
            $product->qty -= $orderProduct->qty;
        }
        $product->save();
    }
}
