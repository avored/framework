<?php

namespace AvoRed\Framework\Product\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class AttributeDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_attribute_controller');

        $dataGrid->model($model)
                ->column('name', ['label' => 'Name', 'sortable' => true])
                ->column('identifier', ['sortable' => true])
                ->linkColumn('edit', [], function ($model) {
                    return "<a href='" . route('admin.attribute.edit', $model->id) . "' >Edit</a>";
                })->linkColumn('show', [], function ($model) {
                    return "<a href='" . route('admin.attribute.show', $model->id) . "' >Show</a>";
                });

        $this->dataGrid = $dataGrid;
    }
}
