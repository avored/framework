<?php

namespace AvoRed\Framework\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \AvoRed\Framework\Payment\all all()
 */
class Payment extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'payment';
    }
}
