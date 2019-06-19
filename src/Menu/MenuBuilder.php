<?php
namespace AvoRed\Framework\Menu;

use Illuminate\Support\Collection;

class MenuBuilder
{
    /**
     * Front Menu Collection.
     * @var \Illuminate\Support\Collection
     */
    protected $collection;

    /**
     * Admin Menu Collection.
     * @var \Illuminate\Support\Collection
     */
    protected $adminCollection;
    /**
     * Admin Menu Flag.
     * @var bool
     */
    protected $admin = false;

    /**
     * Construct for the menu builder
     */
    public function __construct()
    {
        $this->collection = Collection::make([]);
        $this->adminCollection = Collection::make([]);
    }

    /**
     * Make a Front End Menu an Object.
     * @param string $key
     * @param callable $callable
     * @return self
     */
    public function make($key, callable  $callable)
    {
        $menu = new MenuItem($callable);
        $menu->key($key);
        if ($this->admin) {
            $this->adminCollection->put($key, $menu);
        } else {
            $this->collection->put($key, $menu);
        }
        return $this;
    }

    /**
     * Make a admin flag true.
     * @return self
     */
    public function admin()
    {
        $this->admin = true;

        return $this;
    }

    /**
     * Return Menu Object.
     * @var string
     * @return \AvoRed\Framework\Menu\Menu
     */
    public function get($key)
    {
        if ($this->admin) {
            return $this->adminCollection->get($key);
        } else {
            return $this->collection->get($key);
        }
    }

    /**
     * Return all available Menu in Menu.
     * @param void
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        if ($this->admin) {
            return $this->adminCollection->all();
        } else {
            return $this->collection->all();
        }
    }
}
