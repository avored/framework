<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

interface RoleModelInterface
{
    /**
     * Create Role Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Role $role
     */
    public function create(array $data) : Role;

    /**
     * find default admin role for user.
     * @return \AvoRed\Framework\Database\Models\Role $role
     */
    public function findAdminRole() : Role;

    /**
     * find roles for the users.
     * @return \Illuminate\Database\Eloquent\Collection $roles
     */
    public function all() : Collection;

    /**
     * get role options to use as dropdown options.
     * @return \Illuminate\Support\Collection $roles
     */
    public function options() : SupportCollection;
}
