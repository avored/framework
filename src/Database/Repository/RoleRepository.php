<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Role;
use AvoRed\Framework\Database\Contracts\RoleModelInterface;

class RoleRepository implements RoleModelInterface
{
    /**
     * Create Role Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Role $role
     */
    public function create(array $data): Role
    {
        return Role::create($data);
    }

    /**
     * Create Role Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Role $role
     */
    public function findAdminRole(): Role
    {
        return Role::whereName(Role::ADMIN)->first();
    }
}
