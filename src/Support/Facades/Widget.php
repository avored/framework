<?php

namespace AvoRed\Framework\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method \AvoRed\Framework\Widget\WidgetManager static make($name, $widget)
 * @method static \AvoRed\Framework\Widget\WidgetManager static get($key)
 * @method \AvoRed\Framework\Widget\WidgetManager static all()
 * @method \AvoRed\Framework\Widget\WidgetManager static options()
 */
class Widget extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'widget';
    }
}
