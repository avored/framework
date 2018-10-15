<?php

namespace AvoRed\Framework\System\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class CountryDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_country_controller');

        $dataGrid->model($model)
                ->column('id', ['sortable' => true])
                ->column('name', ['label' => 'Name'])

                ->linkColumn('edit', [], function ($model) {
                    return "<a href='" . route('admin.country.edit', $model->id) . "' >Edit</a>";
                })->linkColumn('show', [], function ($model) {
                    return "<a href='" . route('admin.country.show', $model->id) . "' >Show</a>";
                });

        $this->dataGrid = $dataGrid;
    }
}
