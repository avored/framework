<?php

namespace AvoRed\Framework\Support\Contracts;

use AvoRed\Framework\Database\Models\Address;
use AvoRed\Framework\Database\Models\Order;

interface PaymentOptionInterface
{

    /**
     * Get Identifier for this Payment option.
     *
     * @return string
     */
    public function identifier();

   /**
     * Get Title for this Payment Option.
     *
     * @return string
     */
    public function name();

    /**
     * Check whether this payment option requires billing address data.
     *
     * @return boolean
     */
    public function requiresAddress();

    /**
     * Set billing address data.
     *
     * @param \AvoRed\Framework\Database\Models\Address $address
     *
     * @return void
     */
    public function setAddress(Address $address);

    /**
     * Get billing address data.
     *
     * @return \AvoRed\Framework\Database\Models\Address | null
     */
    public function address();

    /**
     * Attempt to process this Payment Option.
     *
     * @return void
     */
    public function process();

    /**
     * Attempts to link an order to a payment attempt.
     *
     * @param \AvoRed\Framework\Database\Models\Order $order
     * @return void
     */
    public function syncOrder(Order $order);
    
    /**
     * Payment Option View Path.
     *
     * @return string
     */
    public function view();

    /**
     * Render Payment Option
     *
     * @return string
     */
    public function render();
    
    /**
     * Payment Option View Data.
     *
     * @return array
     */
    public function with();

}
