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
     * Create new menu object and return.
     *
     * @var string
     * @return \AvoRed\Framework\AdminMenu\AdminMenu
     */
    public function add($key)
    {
        $menu = new AdminMenu();
        $menu->key($key);
        $this->adminMenu->put($key, $menu);

        return $menu;
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
