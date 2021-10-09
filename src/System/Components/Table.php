<?php

namespace AvoRed\Framework\System\Components;

use Illuminate\View\Component;

class Table extends Component
{

    /**
     * Create the component instance.
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
        return view('avored::system.components.table');
    }
}
