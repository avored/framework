<?php

namespace AvoRed\Framework\Permission;

use AvoRed\Framework\Permission\Contracts\Permission as PermissionContracts;

class Permission implements PermissionContracts
{
    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $routes;

    /**
     * @var string
     */
    protected $key;

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

    public function routes($routes = null)
    {
        if (null !== $routes) {
            $this->routes = $routes;

            return $this;
        }

        return $this->routes;
    }
}
