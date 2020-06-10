<?php

namespace AvoRed\Framework\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method \AvoRed\Framework\Tab\Manager static all()
 * @method \AvoRed\Framework\Tab\Manager static put($key, $tab)
 * @method static \AvoRed\Framework\Tab\Manager static get($key)
 */
class Tab extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tab';
    }
}
