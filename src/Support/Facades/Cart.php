<?php

namespace AvoRed\Framework\Support\Facades;

use Illuminate\Support\Facades\Facade as LaravelFacade;

/**
 * Cart Manager
 * @method \AvoRed\Framework\Cart\Manager add($slug)
 */
class Cart extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'cart';
    }
}
