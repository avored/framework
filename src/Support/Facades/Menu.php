<?php

namespace AvoRed\Framework\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method \AvoRed\Framework\Menu\Builer static make($key, callable  $callable)
 * @method \AvoRed\Framework\Menu\Builer static get($key)
 * @method \AvoRed\Framework\Menu\Builer static all()
 */
class Menu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'menu';
    }
}
