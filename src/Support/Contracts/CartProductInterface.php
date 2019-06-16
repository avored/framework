<?php

namespace AvoRed\Framework\Support\Contracts;

interface CartProductInterface
{
    /**
     * Get/Set CartProduct Label.
     * @return string $label
     */
    public function name();

    /**
     * Get/Set CartProduct Route Name.
     * @return string $route
     */
    public function slug();
}
