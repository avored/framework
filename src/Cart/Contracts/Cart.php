<?php

namespace AvoRed\Framework\Cart\Contracts;

interface Cart
{
    /**
     * Get/Set Cart Product Name.
     * @return string|\AvoRed\Framework\Cart\Product
     */
    public function name();

    /**
     * Get/Set Cart Product Qty.
     * @return string|\AvoRed\Framework\Cart\Product
     */
    public function qty();

    /**
     * Get/Set Cart Product Price.
     * @return string|\AvoRed\Framework\Cart\Product
     */
    public function price();
}
