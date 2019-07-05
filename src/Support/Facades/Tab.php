<?php

namespace AvoRed\Framework\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method \AvoRed\Framework\Tab\Manager all()
 * @method \AvoRed\Framework\Tab\Manager put($identifier, $tab)
 */
class Tab extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tab';
    }
}
