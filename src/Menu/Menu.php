<?php

namespace AvoRed\Framework\Menu;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \AvoRed\Framework\Menu\MenuBuilder make($key, callable  $callable)
 * @method static \AvoRed\Framework\Menu\MenuBuilder get($key)
 * @method static \AvoRed\Framework\Menu\MenuBuilder all()
 * @method static \AvoRed\Framework\Menu\MenuBuilder adminMenus()
 */
class Menu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'menu';
    }
}
