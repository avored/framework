<?php

namespace AvoRed\Framework\Payment;

use Illuminate\Support\Collection;

class Manager
{
    /**
     * Payment Options collection.
     * @var \Illuminate\Support\Collection
     */
    public $collection;

    /**
     * Construct for the Payment Manager.
     */
    public function __construct()
    {
        $this->collection = Collection::make([]);
    }

    /**
     * Get all the Payment Options Collection.
     * @return \Illuminate\Support\Collection
     */
    public function all(): Collection
    {
        return $this->collection;
    }

    /**
     * Put Payment class to an collection Collection.
     * @return void
     */
    public function put($payment)
    {
        $this->collection->put($payment->identifier(), $payment);
    }

    /**
     * Put Payment class to an collection Collection.
     * @return void
     */
    public function get($identifier)
    {
        return $this->collection->get($identifier);
    }
}
