<?php

namespace AvoRed\Framework\Support\Contracts;

interface BreadcrumbInterface
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
