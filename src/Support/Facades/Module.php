<?php

namespace AvoRed\Framework\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method \AvoRed\Framework\Modules\Manager all()
 * @method \AvoRed\Framework\Modules\Manager loadModules()
 * @method \AvoRed\Framework\Modules\Manager put($identifier, $moduleInfo)
 * @method \AvoRed\Framework\Modules\Manager get($identifier)
 * @method \AvoRed\Framework\Modules\Manager getByPath($path)
 * @method \AvoRed\Framework\Modules\Manager publishItem($from, $to)
 */
class Module extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'module';
    }
}
