<?php

namespace AvoRed\Framework\AdminConfiguration;

use Illuminate\Support\Facades\Facade as LaravelFacade;

/**
 * @method \AvoRed\Framework\AdminConfiguration\Manager all()
 * @method \AvoRed\Framework\AdminConfiguration\Manager add($key)
 * @method \AvoRed\Framework\AdminConfiguration\Manager get($key)
 * @method \AvoRed\Framework\AdminConfiguration\Manager set($key, $configurationCollection)
 */
class Facade extends LaravelFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'adminconfiguration';
    }
}
