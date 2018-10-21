<?php

namespace AvoRed\Framework\AdminMenu;

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
     *  AvoRed AdminMenu Construct method.
     */
    public function __construct($callable = null)
    {
        if (is_callable($callable)) {
            $callable($this);
        }
    }

    /**
     * Get/Set Admin Menu Label.
     *
     * @param null|string $label
     * @return mixed \AvoRed\Framework\AdminMenu\AdminMenu|string $label
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
     * @param null|string $key
     * @return mixed \AvoRed\Framework\AdminMenu\AdminMenu|string $keu
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
     * Get/Set Admin Menu Route Name
     *
     * @param null|string $route
     * @return mixed \AvoRed\Framework\AdminMenu\AdminMenu|string $routeName
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
     * @param null|string $icon
     * @return mixed \AvoRed\Framework\AdminMenu\AdminMenu|string
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
     * @param null|string $key
     * @param mixed $menuItem
     * @return \AvoRed\Framework\AdminMenu\AdminMenu
     */
    public function subMenu($key = null, $menuItem = null)
    {
        if (null === $menuItem) {
            return $this->subMenu;
        }

        if (is_callable($menuItem)) {
            $menu = new AdminMenu($menuItem);
            $this->subMenu[$key] = $menu;
        } else {
            $this->subMenu[$key] = $menuItem;
        }

        return $this;
    }
}
