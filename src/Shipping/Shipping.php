<?php

namespace AvoRed\Framework\Shipping;

abstract class Shipping
{
    abstract public function process($orderData, $cartProducts);
}
