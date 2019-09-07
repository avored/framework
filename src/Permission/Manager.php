<?php

namespace AvoRed\Framework\Permission;

use Illuminate\Support\Collection;

class Manager
{
    /**
     * Collect all the Permissions from all the modules.
     * @var \Illuminate\Support\Collection
     */
    protected $permissions;

    public function __construct()
    {
        $this->permissions = Collection::make([]);
    }

    /**
     * Get all  Permission Collection.
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return $this->permissions;
    }

    /**
     * Add Permission into Collection.
     * @param string $key
     * @param callable $callable
     * @return \AvoRed\Framework\Permission\Manager
     */
    public function add($key, $callable = null)
    {
        if (null !== $callable) {
            $group = new PermissionGroup($callable);
            $group->key($key);

            $this->permissions->put($key, $group);
        } else {
            $group = new PermissionGroup();

            $group->key($key);
            $this->permissions->put($key, $group);
        }

        return $group;
    }

    /**
     * Get Permission Collection if exists or Return Empty Collection.
     * @param array $item
     * @return \Illuminate\Support\Collection
     */
    public function get($key)
    {
        if ($this->permissions->has($key)) {
            return $this->permissions->get($key);
        }

        return Collection::make([]);
    }

    /**
     * Get Permission Collection if exists or Return Empty Collection.
     * @param array $item
     * @return \Illuminate\Support\Collection
     */
    public function set($key, $permissionCollection)
    {
        $this->permissions->put($key, $permissionCollection);

        return $this;
    }
}
