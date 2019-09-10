<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Permission;

interface PermissionModelInterface
{
    /**
     * Create Permission Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Permission $permission
     */
    public function create(array $data) : Permission;

    /**
     * find permission by given name.
     * @param string $name
     * @return \AvoRed\Framework\Database\Models\Permission $permission
     */
    public function findByName(string $name);

    /**
     * find permission for user.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Permission $permission
     */
    public function find(int $id) : Permission;

    /**
     * get all permissions.
     * @return \Illuminate\Database\Eloquent\Collection $permissions
     */
    public function all() : Collection;
}
