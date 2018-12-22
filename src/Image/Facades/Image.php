<?php

namespace AvoRed\Framework\Image\Facades;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Image extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'image';
    }
}
