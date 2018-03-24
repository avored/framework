<?php

namespace AvoRed\Framework\Tabs;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'AvoRed\Framework\Tabs\TabsMaker';
    }
}
