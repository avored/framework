<?php

namespace AvoRed\Framework\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Cart Manager.
 * @method static \AvoRed\Framework\Cart\Manager add($slug)
 */
class Cart extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cart';
    }
}
