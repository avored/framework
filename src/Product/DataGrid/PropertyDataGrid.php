<?php

namespace AvoRed\Framework\Product\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class PropertyDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_proerty_controller');

        $dataGrid->model($model)
            ->column('id', ['sortable' => true])
            ->column('name')
            ->column('identifier')
            ->linkColumn('edit', [], function ($model) {
                return "<a href='" . route('admin.property.edit', $model->id) . "' >Edit</a>";
            })->linkColumn('show', [], function ($model) {
                return "<a href='" . route('admin.property.show', $model->id) . "' >Show</a>";
            });

        $this->dataGrid = $dataGrid;
    }
}
