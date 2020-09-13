<?php

namespace AvoRed\Framework\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \AvoRed\Framework\Breadcrumb\Builer make($name, callable  $callable)
 * @method static \AvoRed\Framework\Breadcrumb\Builer render($routeName)
 * @method static \AvoRed\Framework\Breadcrumb\Builer get($key)
 */
class Breadcrumb extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'breadcrumb';
    }
}
