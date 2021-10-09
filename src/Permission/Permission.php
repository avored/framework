<?php

namespace AvoRed\Framework\Permission;

use Illuminate\Support\Facades\Facade;

class Permission extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'permission';
    }
}