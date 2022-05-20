<?php

namespace AvoRed\Framework\System\Components\Table;

use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Custom class for table header
     *
     * @var string
     */
    public $class;

    /**
     * Create the component instance.
     *
     * @return void
     */
    public function __construct(
        string $class = ''
    ) {
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('avored::system.components.table.header');
    }
}
