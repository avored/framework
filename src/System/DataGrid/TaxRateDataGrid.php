<?php

namespace AvoRed\Framework\System\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class TaxRateDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_tax_rate_controller');

        $dataGrid->model($model)
            ->column('id', ['sortable' => true])
            ->column('name', ['label' => 'Name'])
            ->linkColumn(
                'edit',
                [],
                function ($model) {
                    return "<a href='" . 
                        route('admin.tax-rate.edit', $model->id) . 
                        "' >Edit</a>";
                }
            )->linkColumn(
                'show', 
                [], 
                function ($model) {
                    return "<a href='" . 
                        route('admin.tax-rate.show', $model->id) . 
                        "' >Show</a>";
                }
            );

        $this->dataGrid = $dataGrid;
    }
}
