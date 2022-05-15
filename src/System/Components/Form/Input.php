<?php

namespace AvoRed\Framework\System\Components\Form;

use Illuminate\View\Component;

class Input extends Component
{
    public $type;

    public $name;

    public $label;

    public $class;

    public $value;

    public function __construct(
        string $name,
        string $type = 'text',
        string $label = '',
        string $class = '',
        $value = ''
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->class = $class;
        $this->value = $value;
    }

    public function render()
    {
        return view('avored::system.components.form.input');
    }
}
