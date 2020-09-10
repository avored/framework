<?php

namespace AvoRed\Framework\Menu;

use stdClass;
use Illuminate\Support\Collection;

class MenuBuilder
{
    /**
     * Front Menu Collection.
     * @var \Illuminate\Support\Collection
     */
    protected $collection;

    /**
     * Construct for the menu builder.
     */
    public function __construct()
    {
        $this->collection = Collection::make([]);
    }

    /**
     * Make a Front End Menu an Object.
     * @param string $key
     * @param callable $callable
     * @return self
     */
    public function make($key, callable $callable)
    {
        $menu = new MenuItem($callable);
        $menu->key($key);
        $this->collection->put($key, $menu);

        return $this;
    }

    /**
     * Return Menu Object.
     * @var string
     * @return \AvoRed\Framework\Menu\Menu
     */
    public function get($key)
    {
        return $this->collection->get($key);
    }

    /**
     * Return all available Menu in Menu.
     * @param void
     * @return \Illuminate\Support\Collection
     */
    public function all($admin = false)
    {
        if ($admin) {
            return $this->collection->filter(function ($item) {
                return $item->type() === MenuItem::ADMIN;
            });
        } else {
            return $this->collection->filter(function ($item) {
                return $item->type() === MenuItem::FRONT;
            });
        }
    }

    public function getMenuItemFromRouteName($name)
    {
        $currentOpenKey = '';
        $currentMenuItemKey = '';
        foreach ($this->collection as $key => $menuGroup) {
            if ($menuGroup->hasSubMenu()) {
                $subMenus = $menuGroup->subMenu($key);

                foreach($subMenus as $subKey => $subMenu) {
                    if ($subMenu->route() == $name) {
                        $currentOpenKey = $key;
                        $currentMenuItemKey = $subMenu->key();
                    }
                }
            }
        }

        return [$currentOpenKey, $currentMenuItemKey];
    }

    /**
     * Return all available Menu in Menu.
     * @param void
     * @return \Illuminate\Support\Collection
     */
    public function frontMenus()
    {
        $frontMenus = collect();

        $i = 1;
        foreach ($this->collection as $item) {
            if ($item->type() === MenuItem::FRONT) {
                $menu = new stdClass;
                $menu->id = $i;
                $menu->name = $item->label;
                $menu->route = $item->route();
                $menu->params = $item->params();
                $menu->url = route($item->route(), $item->params());
                $menu->submenus = $item->submenus ?? [];
                $frontMenus->push($menu);
                $i++;
            }
        }

        return $frontMenus;
    }
   
    /**
     * Return all available Menu in Menu.
     * @param void
     * @return \Illuminate\Support\Collection
     */
    public function adminMenus()
    {
        $adminMenus = $this->all(true);


        $result = $adminMenus->map(function ($item, $index) {
            $routeName = $item->route();
            if ($item->hasSubMenu()) {
                
                
                $subMenus = collect($item->subMenu)->map(function ($item) {
                    $routeName = $item->route();
                    return [
                        'name' => $item->label(),
                        'url' => $routeName === '#' ? '#' : route($routeName, $item->params()),
                    ];
                });
            }
            return [
                'name' => $item->label(),
                'icon' => $item->icon(),
                'url' => $routeName === '#' ? '#' : route($routeName, $item->params()),
                'submenus' => $subMenus
            ];
        });
        

        return $result;
    }
}
