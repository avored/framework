<?php

namespace AvoRed\Framework\Payment;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'AvoRed\Framework\Payment\Manager';
    }
}
