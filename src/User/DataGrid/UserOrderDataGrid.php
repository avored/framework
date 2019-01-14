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
                ->column('payment_option', ['label' => 'Opção Pagamento'])
                ->column('shipping_option', ['label' => 'Opção de Frete'])
                ->column('total_order_value', ['label' => 'Total do Pedido'])
                ->linkColumn('visualizar', [], function ($model) {
                    return "<a href='" . route('admin.order.view', $model->id) . "' >Visualizar</a>";
                });

        $this->dataGrid = $dataGrid;
    }
}
