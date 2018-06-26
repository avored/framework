<?php

namespace AvoRed\Framework\Menu;

use Illuminate\Support\Collection;

class Builder
{
    /**
     * Admin Menu Collection.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $collection;

    public function __construct()
    {
        $this->collection = Collection::make([]);
    }

    /**
     * Make a Front End Menu an Object.
     *
     * @param string $key
     * @param callable $callable
     * @return void
     */
    public function make($key, callable  $callable)
    {
        $menu = new Menu($callable);
        $menu->key($key);

        $this->collection->put($key, $menu);

        return $this;
    }

    /**
     * Return Menu Object.
     *
     * @var string
     * @return \AvoRed\Framework\Menu\Menu
     */
    public function get($key)
    {
        return $this->collection->get($key);
    }

    /**
     * Return all available Menu in Menu.
     *
     * @param void
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return $this->collection->all();
    }
}
