<?php

namespace AvoRed\Framework\Cms\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class PageDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_page_controller');

        $dataGrid->model($model)
              ->column('id', ['sortable' => true])
              ->column('name', ['sortable' => true])
              ->column('slug')
              ->column('meta_title', ['label' => 'Meta Title'])
              ->linkColumn('edit', [], function ($model) {
                  return "<a href='" . route('admin.page.edit', $model->id) . "' >Edit</a>";
              })->linkColumn('show', [], function ($model) {
                  return "<a href='" . route('admin.page.show', $model->id) . "' >Show</a>";
              });

        $this->dataGrid = $dataGrid;
    }
}
