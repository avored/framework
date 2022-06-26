<?php
namespace AvoRed\Framework\Catalog\Tables;

use AvoRed\Framework\Database\Models\Product;
use Illuminate\Support\Collection;
use Livewire\Component;

class ProductTable extends Component
{

    public function columns()
    {
        $columns = Collection::make([]);
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
                return view('avored::catalog.product._actions')
                    ->with('product', $row);
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
            ->with('rows', Product::all())
            ->with('columns', $this->columns())
            ;
    }

}
