<?php
namespace AvoRed\Framework\Catalog\Tables;

use AvoRed\Framework\Database\Models\Category;
use Illuminate\Support\Collection;
use Livewire\Component;

class CategoryTable extends Component
{

    public function columns()
    {
        $columns = Collection::make([]);
        $columns->push([
            'identifier' => 'parent',
            'render' => function ($row) {
                return ($row->parent) ? $row->parent->name : '';
            }
        ]);
        $columns->push([
            'identifier' => 'name'
        ]);
        $columns->push([
            'identifier' => 'slug'
        ]);
        $columns->push([
            'identifier' => 'meta_title'
        ]);
        $columns->push([
            'identifier' => 'meta_description'
        ]);
        $columns->push([
            'identifier' => 'actions',
            'render' => function ($row) {
                return view('avored::catalog.category._actions')
                    ->with('category', $row);
            }
        ]);
        return $columns;
    }
    /**
     * @return mixed
     */
    public function render()
    {
        return view('avored::system.datatable')
            ->with('rows', Category::all())
            ->with('columns', $this->columns())
            ;
    }

}
