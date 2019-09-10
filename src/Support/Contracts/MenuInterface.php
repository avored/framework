<?php

namespace AvoRed\Framework\Support\Contracts;

interface MenuInterface
{
    /**
     * Get/Set Menu Key.
     * @param  string $key
     * @return $key|self
     */
    public function key($key = null);

    /**
     * Get/Set Menu Label.
     * @param  string $label
     * @return $label|self
     */
    public function label($label = null);

    /**
     * Get/Set Menu Icon.
     * @param  string $icon
     * @return $icon|self
     */
    public function icon($icon = null);

    /**
     * Get/Set Menu Attributes.
     * @param  array $attributes
     * @return $attributes|self
     */
    public function attributes($attributes = []);

    /**
     * Get/Set Menu Route Name.
     * @param  string $routeName
     * @return $routeName|self
     */
    public function route($routeName = null);
}
