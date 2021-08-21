<?php
namespace AvoRed\Framework\Catalog\DataTables;

use AvoRed\Framework\Support\Components\Column;
use Livewire\Component;
use stdClass;
use Illuminate\Support\Str;

class CategoryTableComponent extends Component
{

    public $items;
    public $columns;


    public function mount($table = null)
    {
        $this->columns();
        $this->items = $table->items();

    }


    public function columns()
    {
        $this->columns[] = $this->columnCreate('name')
            ->label(__('avored::system.' . Str::of('name')))
            ->visible(true);
        $this->columns[] = $this->columnCreate('slug')
            ->label(__('avored::system.' . Str::of('slug')))
            ->visible(true);
        $this->columns[] = $this->columnCreate('meta_title')
            ->label(__('avored::system.' . Str::of('meta_title')))
            ->visible(true);
        $this->columns[] = $this->columnCreate('meta_description')
            ->label(__('avored::system.' . Str::of('meta_description')))
            ->visible(true);
        $this->columns[] = $this->columnCreate('actions')
            ->label(__('avored::system.' . Str::of('actions')))
            ->visible(true)
            ->render(function () {
                return 'my Actions';
            });
    }


    public function columnCreate($identifier)
    {
        $column = new Column;
        return $column->identifier($identifier);

    }





    public function render()
    {
        return view('avored::components.data-table');
    }
}
