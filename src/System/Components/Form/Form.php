<?php

namespace AvoRed\Framework\System\Components\Form;

use Illuminate\View\Component;

class Form extends Component
{
    public $action;

    public $method;

    public $file;

    public function __construct(
        string $method,
        string $action,
        $file = false
    ) {
        $this->method = $method;
        $this->action = $action;
        $this->file = $file;
    }

    public function render()
    {
        return view('avored::system.components.form.form');
    }
}
