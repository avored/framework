<?php

namespace AvoRed\Framework\Shipping;

use AvoRed\Framework\Shipping\Traits\ShippingUtils;

abstract class Shipping
{
    use ShippingUtils;
    abstract public function process($cartProducts);
}
