<?php

namespace AvoRed\Framework\System\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class SiteCurrencyDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('site_currency_controller');

        $dataGrid->model($model)
                ->column('id', ['sortable' => true])
                ->column('code', ['label' => 'Code'])
                ->column('name', ['label' => 'Name'])
                ->column('conversion_rate', ['label' => 'Convertion Rate'])
                ->linkColumn('edit', [], function ($model) {
                    return "<a href='" . route('admin.site-currency.edit', $model->id) . "' >Edit</a>";
                })->linkColumn('show', [], function ($model) {
                    return "<a href='" . route('admin.site-currency.show', $model->id) . "' >Show</a>";
                });

        $this->dataGrid = $dataGrid;
    }
}
