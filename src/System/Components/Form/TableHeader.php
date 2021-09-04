<?php
namespace AvoRed\Framework\System\Components\Form;

use Illuminate\View\Component;

class TableHeader extends Component
{
    /**
     * The table columns.
     * @var array
     */
    public $columns;


    /**
     * Create the table component instance.
     *
     * @return void
     */
    public function __construct(
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('avored::system.components.form.table-header');
    }
}
