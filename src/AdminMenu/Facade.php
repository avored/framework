<?php

namespace AvoRed\Framework\AdminMenu;

use Illuminate\Support\Facades\Facade as LaravelFacade;

/**
 * @method \AvoRed\Framework\AdminMenu\Builer add($key, $callable)
 * @method \AvoRed\Framework\AdminMenu\Builer get($key)
 * @method \AvoRed\Framework\AdminMenu\Builer getMenuItems()
 *
 */
class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'adminmenu';
    }
}
