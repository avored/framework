<?php

namespace AvoRed\Framework\User\ViewComposers;

use AvoRed\Framework\Models\Database\Role;
use Illuminate\View\View;

class AdminUserFieldsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $roles = Role::all();
        $view->with('roles', $roles);
    }
}
