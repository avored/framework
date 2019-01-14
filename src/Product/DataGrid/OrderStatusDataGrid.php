<?php

namespace AvoRed\Framework\Product\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;
use AvoRed\Framework\DataGrid\Columns\TextColumn;

class OrderStatusDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_product_order_status_controller');

        $dataGrid->model($model)
                ->column('name', function (TextColumn $column) {
                    $column->identifier('name')
                            ->label('Name')
                            ->sortable(true);
                })
                ->linkColumn('is_default', ['label' => 'Is Default'], function ($model) {
                    return ($model->is_default == 1) ? 'Yes' : 'No';
                })
                ->linkColumn('edit', [], function ($model) {
                    return "<a href='" . route('admin.order-status.edit', $model->id) . "' >Edit</a>";
                })->linkColumn('show', [], function ($model) {
                    return "<a href='" . route('admin.order-status.show', $model->id) . "' >Show</a>";
                });

        $this->dataGrid = $dataGrid;
    }
}
