<?php

namespace AvoRed\Framework\System\Components\Form;

use Illuminate\View\Component;

class Select extends Component
{
    /**
     * The form input name.
     * @var string
     */
    public $name;
    /**
     * The form input label.
     * @var string
     */
    public $label;
    /**
     * The form input class.
     * @var string
     */
    public $class;
    /**
     * The form input value.
     * @var string
     */
    public $value;

    /**
     * Create the component instance.
     *
     * @param  string  $name
     * @param  string  $type
     * @param  string  $label
     * @return void
     */
    public function __construct(
        string $name,
        string $label = '',
        string $class = '',
        $value = ''
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->class = $class;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('avored::system.components.form.select');
    }
}
