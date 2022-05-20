<?php

namespace AvoRed\Framework\Module;

use Illuminate\Support\Facades\Facade;

/**
 * @method \AvoRed\Framework\Modules\Manager static all()
 * @method \AvoRed\Framework\Modules\Manager static loadModules()
 * @method \AvoRed\Framework\Modules\Manager static put($identifier, $moduleInfo)
 * @method \AvoRed\Framework\Modules\Manager static get($identifier): ModuleItem
 * @method \AvoRed\Framework\Modules\Manager static getByPath($path)
 * @method \AvoRed\Framework\Modules\Manager static publishItem($from, $to)
 */
class Module extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'module';
    }
}
