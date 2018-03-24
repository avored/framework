<?php

namespace AvoRed\Framework\Permission;

use Illuminate\Support\Collection;
use AvoRed\Framework\Permission\Contracts\Permission as PermissionContracts;

class PermissionGroup implements PermissionContracts
{
    /**
     * @var string
     */
    protected $label;

    /**
     * @var array
     */
    public $permissionList;

    /**
     * @var string
     */
    protected $key;

    public function __construct()
    {
        $this->permissionList = Collection::make([]);
    }

    public function label($label = null)
    {
        if (null !== $label) {
            $this->label = $label;

            return $this;
        }

        return $this->label;
    }

    public function key($key = null)
    {
        if (null !== $key) {
            $this->key = $key;

            return $this;
        }

        return $this->key;
    }

    public function addPermission($key = null)
    {
        $permission = new Permission();

        $permission->key($key);
        $this->permissionList->put($key, $permission);

        return $permission;
    }
}
