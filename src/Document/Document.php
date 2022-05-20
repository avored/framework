<?php

namespace AvoRed\Framework\Document;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \AvoRed\Framework\Document\Manager upload($file)
 */
class Document extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'document';
    }
}
