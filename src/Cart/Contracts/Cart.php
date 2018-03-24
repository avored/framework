<?php

namespace AvoRed\Framework\Cart\Contracts;

interface Cart
{
    /**
     * Get/Set Cart Product Name.
     * @return null|string
     */
    public function name();

    /**
     * Get/Set Cart Product Qty.
     * @return null|string
     */
    public function qty();

    /**
     * Get/Set Cart Product Price.
     * @return null|string
     */
    public function price();
}
