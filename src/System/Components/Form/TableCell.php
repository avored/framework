<?php
namespace AvoRed\Framework\System\Components\Form;

use Illuminate\Support\Arr;
use Illuminate\View\Component;

class TableCell  extends Component
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
        $column = null,
        $item = null
    ) {
        $this->column = $column;
        $this->item = $item;

    }

    public function value()
    {
        if ($this->column->identifier() === 'actions') {
            dd($this->column, $this->item);
        }
        return $this->column->render($this->item);
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        $value = $this->value();
        return view('avored::system.components.form.table-cell', ['value' => $value]);
    }
}
