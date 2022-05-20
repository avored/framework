<?php

namespace AvoRed\Framework\Shipping;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \AvoRed\Framework\Shipping\all all()
 */
class Shipping extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'shipping';
    }
}
