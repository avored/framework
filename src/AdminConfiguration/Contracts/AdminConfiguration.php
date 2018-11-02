<?php

namespace AvoRed\Framework\AdminConfiguration\Contracts;

interface AdminConfiguration
{
    /**
     * Get/Set Admin Configuration Name.
     * @return string|null $name
     */
    public function name();

    /**
     * Get/Set Admin Configuration Label.
     * @return string $label
     */
    public function label();

    /**
     * Get/Set Admin Configuratuin Type .
     * @return string $icon
     */
    public function type();

    /**
     * Get/Set Admin Configuration Route Name.
     * @return string|null $key
     */
    public function key();
}
