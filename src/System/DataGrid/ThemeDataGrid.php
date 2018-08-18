<?php

namespace AvoRed\Framework\System\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class ThemeDataGrid
{
    public $dataGrid;

    public function __construct($model, $activeTheme)
    {

       
        $dataGrid = DataGrid::make('admin_theme_controller');

        $dataGrid->model($model)
                ->column('name', ['label' => 'Name'])
                ->column('identifier', ['label' => 'Identifier'])
                ->linkColumn('is_active', ['label' => 'Is Active'],function($model) use ($activeTheme) {

                    if($model['identifier'] == $activeTheme) {
                        return "Yes";
                    } 

                    return "No";
                });
              

        $this->dataGrid = $dataGrid;
    }
}
