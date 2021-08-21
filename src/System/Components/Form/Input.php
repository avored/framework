<?php
namespace AvoRed\Framework\System\Components\Form;

use Illuminate\View\Component;

class Input extends Component
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
        string $label = ''
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('avored::system.components.form.input');
    }
}
