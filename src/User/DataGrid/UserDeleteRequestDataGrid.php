<?php

namespace AvoRed\Framework\User\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class UserDeleteRequestDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_user_delete_request_controller');

        $dataGrid->model($model)
            ->column('id', ['sortable' => true])
            ->column('first_name', ['label' => 'First Name'])
            ->column('last_name', ['label' => 'Last Name'])
            ->column('email', ['label' => 'Email'])
            ->column('delete_due_date', ['label' => 'Delete Due Date'])
            ->linkColumn(
                'destroy', 
                [], 
                function ($model) {
                    return "
                        <a 
                            onclick='event.preventDefault();jQuery('user-delete-request-{$model->id}').submit()'
                            href='" . route('admin.user-delete-request.destroy', $model->id) . "' >
                            Delete
                        </a>
                        <form 
                            id='user-delete-request-". $model->id ."'
                            method='post' 
                            action='" . route('admin.user-delete-request.destroy', $model->id) . "'>
                                <input type='hidden' name='_token' value='". csrf_token() ."' />
                                <input type='hidden' name='_token' value='delete' />
                        </form>
                    ";}
            );

        $this->dataGrid = $dataGrid;
    }
}
