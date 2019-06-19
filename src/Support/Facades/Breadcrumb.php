<?php

namespace AvoRed\Framework\Support\Facades;

use Illuminate\Support\Facades\Facade as LaravelFacade;

/**
 *
 * @method \AvoRed\Framework\Breadcrumb\Builer make($name, callable  $callable)
 * @method \AvoRed\Framework\Breadcrumb\Builer render($routeName)
 * @method \AvoRed\Framework\Breadcrumb\Builer get($key)
 */
class Breadcrumb extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'breadcrumb';
    }
}
