<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

interface RoleModelInterface extends BaseInterface
{

    /**
     * find default admin role for user.
     * @return \AvoRed\Framework\Database\Models\Role $role
     */
    public function findAdminRole() : Role;

    /**
     * get role options to use as dropdown options.
     * @return \Illuminate\Support\Collection $roles
     */
    public function options() : SupportCollection;
}
