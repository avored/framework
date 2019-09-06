<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Permission;
use AvoRed\Framework\Database\Contracts\PermissionModelInterface;

class PermissionRepository implements PermissionModelInterface
{
    /**
     * Create Permission Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Permission $permission
     */
    public function create(array $data): Permission
    {
        return Permission::create($data);
    }

    /**
     * find Permission by given name from database.
     * @param string $name
     * @return \AvoRed\Framework\Database\Models\Permission $permission
     */
    public function findByName(string $name)
    {
        return Permission::whereName($name)->first();
    }

    /**
     * find Permission by given id from database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Permission $permission
     */
    public function find(int $id): Permission
    {
        return Permission::find($id);
    }

    /**
     * Get all the permissions.
     * @return \Illuminate\Database\Eloquent\Collection $permissions
     */
    public function all() : Collection
    {
        return Permission::all();
    }
}
