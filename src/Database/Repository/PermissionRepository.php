<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Contracts\PermissionModelInterface;
use AvoRed\Framework\Database\Models\Permission;

class PermissionRepository extends BaseRepository implements PermissionModelInterface
{
    /**
     * @var Permission
     */
    protected $model;

    /**
     * Construct for the Permission Repository
     */
    public function __construct()
    {
        $this->model = new Permission();
    }

    /**
     * Get the model for the repository
     * @return Permission
     */
    public function model()
    {
        return $this->model;
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
}
