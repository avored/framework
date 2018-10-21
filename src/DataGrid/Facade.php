<?php

namespace AvoRed\Framework\DataGrid;

use Illuminate\Support\Facades\Facade as LaravelFacade;

/**
 *
 * @method \AvoRed\Framework\DataGrid\Manager make($name)
 * @method \AvoRed\Framework\DataGrid\Manager setPagination($item = 10)
 * @method \AvoRed\Framework\DataGrid\Manager render($dataGrid)
 *
 */
class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'datagrid';
    }
}
