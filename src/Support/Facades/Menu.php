<?php

namespace AvoRed\Framework\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method \AvoRed\Framework\Menu\Builer make($key, callable  $callable)
 * @method \AvoRed\Framework\Menu\Builer get($key)
 * @method \AvoRed\Framework\Menu\Builer all()
 */
class Menu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'menu';
    }
}
