<?php

namespace AvoRed\Framework\Permission;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;

class PermissionGroup
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

    /**
     * Construct for a permission group.
     * @param callable $callable
     * @return void
     */
    public function __construct($callable = null)
    {
        $this->permissionList = Collection::make([]);
        if (null !== $callable) {
            $callable($this);
        }
    }

    /**
     * Specify a label for permission group.
     *
     * @param string $label
     * @return mixed $this|$label
     */
    public function label($label = null)
    {
        if (null !== $label) {
            $this->label = $label;

            return $this;
        }

        if (Lang::has($this->label)) {
            return __($this->label);
        }

        return $this->label;
    }

    /**
     * Add an Unique key to a group of permission.
     * @param string $key
     * @return mixed $key|$this
     */
    public function key($key = null)
    {
        if (null !== $key) {
            $this->key = $key;

            return $this;
        }

        return $this->key;
    }

    /**
     * Add Permission to a group.
     * @param string $key
     * @param callable $callable
     * @return \AvoRed\Framework\Permission\Permission $permission
     */
    public function addPermission($key, $callable = null)
    {
        if (null !== $callable) {
            $permission = new Permission($callable);
            $permission->key($key);

            $this->permissionList->put($key, $permission);
        } else {
            $permission = new Permission();

            $permission->key($key);
            $this->permissionList->put($key, $permission);
        }

        return $permission;
    }
}
