<?php

namespace AvoRed\Framework\Menu;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \AvoRed\Framework\Menu\Builer make($key, callable  $callable)
 * @method static \AvoRed\Framework\Menu\Builer get($key)
 * @method static \AvoRed\Framework\Menu\Builer all()
 */
class Menu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'menu';
    }
}