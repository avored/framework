<?php

namespace AvoRed\Framework\Events;

use Illuminate\Queue\SerializesModels;
use AvoRed\Framework\Models\Database\Product;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use AvoRed\Ecommerce\Http\Requests\ProductRequest;

class ProductAfterSave
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Product Model Object
     *
     * @var \AvoRed\Ecommerce\Models\Database\Product|Product $product
     */
    public $product = null;

    /**
     * Product Edit Page Form Fields Data
     *
     * @var array $data
     */
    public $data = [];

    /**
     * Create a new event instance.
     *
     * @param \AvoRed\Ecommerce\Models\Database\Product $product
     * @param data $data
     * @return void
     */
    public function __construct(Product $product, array $data)
    {
        $this->product = $product;
        $this->data = $data;
    }
}
