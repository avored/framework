<?php
namespace AvoRed\Framework\System\ViewComposers;

use AvoRed\Framework\Support\Facades\Menu;
use Illuminate\View\View;

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
        $adminMenus = Menu::admin()->all();
        $view->with('adminMenus', $adminMenus);
    }
}
