<?php

namespace AvoRed\Framework\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method \AvoRed\Framework\Breadcrumb\Builer static make($name, callable  $callable)
 * @method \AvoRed\Framework\Breadcrumb\Builer static render($routeName)
 * @method \AvoRed\Framework\Breadcrumb\Builer static get($key)
 */
class Breadcrumb extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'breadcrumb';
    }
}
