<?php

namespace AvoRed\Framework\Menu\Facades;

use Illuminate\Support\Facades\Facade as LaravelFacade;

/**
 * @method \AvoRed\Framework\Menu\Builer make($key, callable  $callable)
 * @method \AvoRed\Framework\Menu\Builer get($key)
 * @method \AvoRed\Framework\Menu\Builer all()
 *
 */class Menu extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'menu';
    }
}
