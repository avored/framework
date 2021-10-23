<?php

namespace AvoRed\Framework\System\Components\Form;

use Illuminate\View\Component;

class Upload extends Component
{
    /**
     * The form input type.
     * @var string
     */
    public $type;

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
     * The form input multiple.
     * @var string
     */
    public $multiple;

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
        string $type = 'text',
        string $label = '',
        string $class = '',
        $value = '',
        $multiple = false
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->class = $class;
        $this->value = $value;
        $this->multiple = $multiple;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('avored::system.components.form.upload');
    }
}
