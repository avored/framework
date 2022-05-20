<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Permission;
use AvoRed\Framework\Database\Contracts\PermissionModelInterface;

class PermissionRepository extends BaseRepository implements PermissionModelInterface
{
    /**
     * @var Permission $model
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
