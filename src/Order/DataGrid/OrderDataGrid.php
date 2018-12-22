<?php

namespace AvoRed\Framework\Order\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class OrderDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_order_controller');

        $dataGrid->model($model)
                    ->column('id', ['label' => 'Order Number', 'sortable' => true])
                    ->column('shipping_option', ['label' => 'Shipping Option'])
                    ->column('payment_option', ['label' => 'Payment Option'])
                    ->linkColumn('order_status', ['label' => 'Status'], function ($model) {
                        return $model->orderStatus->name;
                    })
                    ->column('created_at', ['label' => 'Date created'])
                    ->column('updated_at', ['label' => 'Recent updated'])
                    ->linkColumn('view', [], function ($model) {
                        return "<a href='" . route('admin.order.view', $model->id) . "' >View</a>";
                    });

        $this->dataGrid = $dataGrid;
    }
}
