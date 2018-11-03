<?php

namespace AvoRed\Framework\User\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class UserGroupDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_user_group_controller');

        $dataGrid->model($model)
                ->column('id', ['sortable' => true])
                ->column('name', ['label' => 'Name'])
                ->linkColumn('edit', [], function ($model) {
                    return "<a href='" . route('admin.user-group.edit', $model->id) . "' >Edit</a>";
                })->linkColumn('show', [], function ($model) {
                    return "<a href='" . route('admin.user-group.show', $model->id) . "' >Show</a>";
                });

        $this->dataGrid = $dataGrid;
    }
}
