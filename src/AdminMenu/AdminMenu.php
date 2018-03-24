<?php

namespace AvoRed\Framework\AdminMenu;

use Illuminate\Support\Facades\Route;
use AvoRed\Framework\AdminMenu\Contracts\AdminMenu as AdminMenuContracts;

class AdminMenu implements AdminMenuContracts
{
    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $icon;

    /**
     * @var array
     */
    protected $subMenu;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $routeName;

    /**
     * Get/Set Admin Menu Label.
     *
     * @return \AvoRed\Framework\AdminMenu\AdminMenu|string
     */
    public function label($label = null)
    {
        if (null !== $label) {
            $this->label = $label;

            return $this;
        }

        return $this->label;
    }

    /**
     * Get/Set Admin Menu Identifier.
     *
     * @return \AvoRed\Framework\AdminMenu\AdminMenu|string
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
     * Get/Set Admin Menu Route Name.
     *
     * @return \AvoRed\Framework\AdminMenu\AdminMenu|string
     */
    public function route($routeName = null)
    {
        if (null !== $routeName) {
            $this->routeName = $routeName;

            return $this;
        }

        return $this->routeName;
    }

    /**
     * Get/Set Admin Menu Icon.
     *
     * @return \AvoRed\Framework\AdminMenu\AdminMenu|string
     */
    public function icon($icon = null)
    {
        if (null !== $icon) {
            $this->icon = $icon;

            return $this;
        }

        return $this->icon;
    }

    /**
     * Get/Set Admin Menu Sub Menu.
     *
     * @return \AvoRed\Framework\AdminMenu\AdminMenu
     */
    public function subMenu($key = null, $menuItem = null)
    {
        if (null !== $key) {
            $this->subMenu[$key] = $menuItem;

            return $this;
        }

        return $this->subMenu;
    }

    /**
     * Get Dropdown Class none.
     *
     * @return string
     */
    public function menuClass():string
    {
        $currentRouteName = Route::currentRouteName();
        $found = false;

        if (count($this->subMenu()) > 0) {
            foreach ($this->subMenu() as $menu) {
                if ($menu->route() == $currentRouteName) {
                    $found = true;
                }
            }
        }

        if (false === $found) {
            return 'd-none';
        } else {
            return '';
        }
    }
}
