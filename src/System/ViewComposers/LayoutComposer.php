<?php

namespace AvoRed\Framework\System\ViewComposers;

use Illuminate\View\View;
use AvoRed\Framework\Support\Facades\Menu;
use Illuminate\Support\Facades\Route;

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
        $routeName = Route::currentRouteName();

        [$currentOpenKey, $currentMenuItemKey] = Menu::getMenuItemFromRouteName($routeName);

        
        $adminMenus = Menu::adminMenus();
        // dd($adminMenus);
        $view->with('adminMenus', $adminMenus)
            ->with('currentOpenKey', $currentOpenKey)
            ->with('currentMenuItemKey', $currentMenuItemKey);
    }
}