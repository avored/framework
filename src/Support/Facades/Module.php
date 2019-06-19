<?php

namespace AvoRed\Framework\Support\Facades;

use Illuminate\Support\Facades\Facade as LaraveFacade;

class Module extends LaraveFacade
{
    protected static function getFacadeAccessor()
    {
        return 'module';
    }
}
