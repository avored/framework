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
            'identifier' => 'parent'
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
            'identifier' => 'actions'
        ]);
        return $columns;
    }
    /**
     * @return mixed
     */
    public function render()
    {
        return view('avored::system.datatable')
            ->with('categories', Category::all())
            ->with('columns', $this->columns())
            ;
    }

}
