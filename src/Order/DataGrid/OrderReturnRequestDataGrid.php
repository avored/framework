<?php

namespace AvoRed\Framework\Order\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class OrderReturnRequestDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_order_return_request_controller');

        $dataGrid->model($model)
                    ->column('order_id', ['label' => 'Requisição Nº', 'sortable' => true])
                    ->column('customer_name', ['label' => 'Cliente', 'sortable' => true])
                    ->column('customer_phone', ['label' => 'Telefone', 'sortable' => true])
                    ->column('comment', ['label' => 'Comentário'])
                    ->column('status', ['label' => 'Status'])
                    ->linkColumn('view', [], function ($model) {
                        return "<a href='" . route('admin.order-return-request.view', $model->id) . "' >Visualizar</a>";
                    });

        $this->dataGrid = $dataGrid;
    }
}
