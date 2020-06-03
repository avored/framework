<?php

namespace AvoRed\Framework\Order\Events;

use AvoRed\Framework\Database\Models\OrderProduct;
use Illuminate\Queue\SerializesModels;

class OrderProductCreated
{
    use SerializesModels;

    /**
     * Order Product model
     * @var OrderProduct $orderProduct
     */
    public $orderProduct;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(OrderProduct $orderProduct)
    {
        $this->orderProduct = $orderProduct;
    }
}
