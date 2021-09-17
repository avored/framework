<?php

namespace AvoRed\Framework\System\Components;

use AvoRed\Framework\Menu\Menu;
use Illuminate\View\Component;

class Layout extends Component
{

    /**
     * The layout name.
     * @var string
     */
    public $name;

    /**
     * The admin Menus.
     * @var collection
     */
    public $adminMenus;

    /**
     * Create the component instance.
     *
     * @param  string  $name
     * @return void
     */
    public function __construct(
        string $name = 'app'
    ) {
        $this->name = $name;
        $this->adminMenus = Menu::adminMenus();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('avored::system.components.layouts.' . $this->name);
    }
}
