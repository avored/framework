<?php

namespace AvoRed\Framework\System\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class LanguageDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_system_language_controller');

        $dataGrid->model($model)
            ->column('id', ['sortable' => true])
            ->column('name', ['label' => 'Name'])
            ->linkColumn(
                'edit', 
                [], 
                function ($model) {
                    return "<a href='" . route('admin.language.edit', $model->id) . "' >Edit</a>";
                }
            )->linkColumn(
                'show', 
                [], 
                function ($model) {
                    return "<a href='" . route('admin.language.show', $model->id) . "' >Show</a>";
                }
            );

        $this->dataGrid = $dataGrid;
    }
}
