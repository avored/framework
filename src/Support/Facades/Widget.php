<?php

namespace AvoRed\Framework\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \AvoRed\Framework\Widget\WidgetManager make($name, $widget)
 * @method static \AvoRed\Framework\Widget\WidgetManager get($key)
 * @method static \AvoRed\Framework\Widget\WidgetManager all()
 * @method static \AvoRed\Framework\Widget\WidgetManager options()
 */
class Widget extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'widget';
    }
}
