<?php

namespace AvoRed\Framework\User\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class UserDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_user_controller');

        $dataGrid->model($model)
                ->column('id', ['sortable' => true])
                ->column('first_name', ['label' => 'First Name'])
                ->column('last_name', ['label' => 'Last Name'])
                ->column('email', ['label' => 'Email'])
                ->linkColumn('edit', [], function ($model) {
                    return "<a href='" . route('admin.user.edit', $model->id) . "' >Edit</a>";
                })->linkColumn('show', [], function ($model) {
                    return "<a href='" . route('admin.user.show', $model->id) . "' >Show</a>";
                });

        $this->dataGrid = $dataGrid;
    }
}
