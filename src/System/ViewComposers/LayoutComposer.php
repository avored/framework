<?php

namespace AvoRed\Framework\System\ViewComposers;

use Illuminate\View\View;
use AvoRed\Framework\Support\Facades\Menu;

class LayoutComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $adminMenus = Menu::all($admin = true);
        $view->with('adminMenus', $adminMenus);
    }
}
