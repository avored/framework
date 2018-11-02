<?php

namespace AvoRed\Framework\AdminMenu;

use Illuminate\Support\Collection;

class Builder
{
    /**
     * Admin Menu Collection.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $adminMenu;

    public function __construct()
    {
        $this->adminMenu = Collection::make([]);
    }

    /**
     * Add Menu to a Collection
     *
     * @param string
     * @param callable $callable
     * @return \AvoRed\Framework\AdminMenu\Builder
     */
    public function add($key, $callable)
    {
        $menu = new AdminMenu($callable);

        $this->adminMenu->put($key, $menu);

        return $this;
    }

    /**
     * Return Admin Menu Object.
     *
     * @var string
     * @return \AvoRed\Framework\AdminMenu\AdminMenu
     */
    public function get($key)
    {
        return $this->adminMenu->get($key);
    }

    /**
     * Return all available Menu in Admin Menu.
     *
     *
     * @param void
     * @return \Illuminate\Support\Collection
     */
    public function getMenuItems()
    {
        return $this->adminMenu->all();
    }
}
