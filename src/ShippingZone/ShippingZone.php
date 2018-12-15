<?php

namespace AvoRed\Framework\ShippingZone;

abstract class ShippingZone
{
    abstract public function process($cartProducts);
}
