<?php

namespace AvoRed\Framework\System\Components;

use Illuminate\View\Component;

class Link extends Component
{
    /**
     * The link url.
     * @var string
     */
    public $url;
    /**
     * The url style.
     * @var string
     */
    public $style;
    /**
     * The url override class.
     * @var string
     */
    public $class;

    /**
     * Create the component instance.
     *
     * @param  string  $url
     * @param  string  $style
     * @param  string  $class
     * @return void
     */
    public function __construct(
        string $url,
        string $style = 'normal',
        string $class = ''
    ) {
        $this->url = $url;
        $this->style = $style;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('avored::system.components.form.link');
    }
}
