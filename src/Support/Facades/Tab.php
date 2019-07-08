<?php

namespace AvoRed\Framework\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method \AvoRed\Framework\Tab\Manager all()
 * @method \AvoRed\Framework\Tab\Manager put($key, $tab)
 * @method \AvoRed\Framework\Tab\Manager get($key)
 */
class Tab extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tab';
    }
}
