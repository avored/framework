<?php

namespace AvoRed\Framework\Support\Facades;

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
