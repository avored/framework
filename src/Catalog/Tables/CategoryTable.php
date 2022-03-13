<?php
namespace AvoRed\Framework\Catalog\Tables;

use AvoRed\Framework\Database\Models\Category;
use Livewire\Component;

class CategoryTable extends Component
{

    /**
     * @return mixed
     */
    public function render()
    {
        return view('avored::system.datatable')
            ->with('categories', Category::all())
            ;
    }

}