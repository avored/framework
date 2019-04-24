<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\Role;
use Illuminate\Database\Eloquent\Collection;

interface RoleModelInterface
{
    /**
     * Create Role Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Role $role
     */
    public function create(array $data) : Role;

    /**
     * find default admin role for user
     * @return \AvoRed\Framework\Database\Models\Role $role
     */
    public function findAdminRole() : Role;

    /**
     * find roles for the users
     * @return \Illuminate\Database\Eloquent\Collection $roles
     */
    public function all() : Collection;
}
