<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\Role;

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
}
