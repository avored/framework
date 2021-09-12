<?php

namespace AvoRed\Framework\System\Components\Form;

use Illuminate\View\Component;
use Illuminate\View\View;

class Alert extends Component
{
    /**
     * The form input type.
     * @var string
     */
    public $type;

    /**
     * The form input message.
     * @var string
     */
    public $message;

    /**
     * Create the component instance.
     *
     * @param  string  $message
     * @param  string  $type
     * @param  string  $label
     * @return void
     */
    public function __construct(
        string $message = null,
        string $type = 'success'
    ) {
        $this->message = $message;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render(): View
    {
        return view('avored::system.components.form.alert');
    }
}
