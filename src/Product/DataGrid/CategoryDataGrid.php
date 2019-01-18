<?php

namespace AvoRed\Framework\Product\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;
use AvoRed\Framework\DataGrid\Columns\TextColumn;

class CategoryDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_category_controller');

        $dataGrid->model($model)
                ->column('name', function (TextColumn $column) {
                    $column->identifier('name')
                            ->label('Nome')
                            ->sortable(true)
                            ->canFilter(true);
                })
                ->column('slug', function (TextColumn $column) {
                    $column->identifier('slug')
                            ->label('Slug')
                            ->sortable(true)
                            ->canFilter(true);
                })
                ->linkColumn('edit', [], function ($model) {
                    return "<a href='" . route('admin.category.edit', $model->id) . "' >Editar</a>";
                })->linkColumn('show', [], function ($model) {
                    return "<a href='" . route('admin.category.show', $model->id) . "' >Visualizar</a>";
                });

        $this->dataGrid = $dataGrid;
    }
}
