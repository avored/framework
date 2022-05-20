<?php

namespace AvoRed\Framework\Cart;

use Illuminate\Support\Facades\Facade;

/**
 * Cart Manager.
 * @method static \AvoRed\Framework\Cart\CartManager add($slug)
 */
class Cart extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cart';
    }
}
