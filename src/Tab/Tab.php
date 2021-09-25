<?php

namespace AvoRed\Framework\Tab;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \AvoRed\Framework\Tab\Manager all()
 * @method static \AvoRed\Framework\Tab\Manager put($key, $tab)
 * @method static \AvoRed\Framework\Tab\Manager  get($key)
 */
class Tab extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tab';
    }
}
