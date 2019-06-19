<?php

namespace AvoRed\Framework\Support\Contracts;

interface PermissionInterface
{
    /**
     * Get/Set Permission Key.
     * @param  string $key
     * @return $key|self
     */
    public function key($key = null);

    /**
     * Get/Set Permission Label.
     * @param  string $label
     * @return $label|self
     */
    public function label($label = null);

    /**
     * Get/Set Permission routes.
     * @param  string $routes
     * @return $routes|self
     */
    public function routes($icon = null);
}
