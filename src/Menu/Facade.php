<?php

namespace AvoRed\Framework\Menu;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'menu';
    }
}
