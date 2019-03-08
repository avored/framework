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
            ->column(
                'name',
                function (TextColumn $column) {
                    $column->identifier('name')
                        ->label('Name')
                        ->sortable(true)
                        ->canFilter(false);
                }
            )->column(
                'slug',
                function (TextColumn $column) {
                    $column->identifier('slug')
                        ->label('Slug')
                        ->sortable(true)
                        ->canFilter(false);
                }
            )->linkColumn(
                'edit',
                [],
                function ($model) {
                    return "<a href='" . route('admin.category.edit', $model->id) . "' >Edit</a>";
                }
            )->linkColumn(
                'show',
                [],
                function ($model) {
                    return "<a href='" . route('admin.category.show', $model->id) . "' >Show</a>";
                }
            );

        $this->dataGrid = $dataGrid;
    }
}
