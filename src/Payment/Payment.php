<?php

namespace AvoRed\Framework\Payment;

abstract class Payment
{
    abstract public function process($orderData, $cartProducts, $request);
}
