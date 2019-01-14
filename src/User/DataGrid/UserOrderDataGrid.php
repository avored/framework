<?php

namespace AvoRed\Framework\User\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class UserOrderDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_user_controller_show_orders');

        $dataGrid->model($model)
                ->column('id', ['sortable' => true])
                ->column('payment_option', ['label' => 'Payment Options'])
                ->column('shipping_option', ['label' => 'Shipping Options'])
                ->linkColumn('show', [], function ($model) {
                    return "<a href='" . route('admin.order.view', $model->id) . "' >Show Details</a>";
                });

        $this->dataGrid = $dataGrid;
    }
}
