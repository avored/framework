<?php

namespace AvoRed\Framework\Product\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class ProductDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_product_controller');

        $dataGrid->model($model)
            ->column('id', ['sortable' => true])
            ->column('sku', ['sortable' => true])
            ->linkColumn('image', [], function ($model) {
                return "<img src='" . $model->image->smallUrl . "' style='max-height: 50px;' />";
            })->column('name')
            ->linkColumn('edit', [], function ($model) {
                return "<a href='" . route('admin.product.edit', $model->id) . "' >Editar</a>";
            })->linkColumn('show', [], function ($model) {
                return "<a href='" . route('admin.product.show', $model->id) . "' >Visualizar</a>";
            });

        $this->dataGrid = $dataGrid;
    }
}
