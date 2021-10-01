<?php

namespace AvoRed\Framework\System\Components\Form;

use Illuminate\View\Component;

class Checkbox extends Component
{
    /**
     * The form checkbox input class.
     * @var string
     */
    public $class;
    /**
     * The form checkbox input name.
     * @var string
     */
    public $name;
    /**
     * The form checkbox input checked value.
     * @var string
     */
    public $checkedValue;
    /**
     * The form checkbox input label.
     * @var string
     */
    public $label;
    /**
     * The form checkbox input value.
     * @var mixed
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
        $checkedValue = 1,
        string $label = '',
        string $class = '',
        $value = ''
    ) {
        $this->name = $name;
        $this->checkedValue = $checkedValue;
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
        return view('avored::system.components.form.checkbox');
    }
}
