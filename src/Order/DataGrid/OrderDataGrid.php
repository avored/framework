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
                    ->column('id', ['label' => 'N. Pedido', 'sortable' => true])
                    ->column('shipping_option', ['label' => 'Frete'])
                    ->column('payment_option', ['label' => 'Pagamento'])
                    ->linkColumn('order_status', ['label' => 'Status'], function ($model) {
                        return $model->orderStatus->name;
                    })
                    ->column('created_at', ['label' => 'Criação'])
                    ->column('updated_at', ['label' => 'Atualização'])
                    ->linkColumn('view', [], function ($model) {
                        return "<a href='" . route('admin.order.view', $model->id) . "' >Visualizar</a>";
                    });

        $this->dataGrid = $dataGrid;
    }
}
