<?php

namespace AvoRed\Framework\Breadcrumb\Contracts;

interface Breadcrumb
{
    /**
     * Get/Set Breadcrumb Label.
     * @return string $label
     */
    public function label();

    /**
     * Get/Set Breadcrumb Route Name.
     * @return string $route
     */
    public function route();
}
