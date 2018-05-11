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
        if(null === $menuItem) {
            return $this->subMenu;
        }

        $this->subMenu[$key] = $menuItem;

        return $this;

    }
}
