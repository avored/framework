<?php

namespace AvoRed\Framework\Theme;

use Illuminate\Support\Facades\Facade as LaraveFacade;

/**
 * @method \AvoRed\Framework\Theme all()
 *
 *
 */
class Facade extends LaraveFacade
{
    protected static function getFacadeAccessor()
    {
        return 'theme';
    }
}
