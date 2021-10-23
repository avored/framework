<?php

namespace AvoRed\Framework\System\Components\Form;

use Illuminate\View\Component;

class Form extends Component
{
    /**
     * The form action.
     * @var string
     */
    public $action;

    /**
     * The form method.
     * @var string
     */
    public $method;

    /**
     * The form file.
     * @var string
     */
    public $file;


    /**
     * Create the component instance.
     *
     * @param  string  $method
     * @param  string  $action
     * @param  string  $label
     * @return void
     */
    public function __construct(
        string $method,
        string $action,
        $file = false
    ) {
        $this->method = $method;
        $this->action = $action;
        $this->file = $file;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('avored::system.components.form.form');
    }
}
