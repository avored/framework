<?php
namespace AvoRed\Framework\Support\Contracts;

interface WidgetInterface
{
    /**
     * Get/Set Widget Label.
     * @return string $label
     */
    public function label();
    /**
     * Get/Set Widget Type.
     * @return string $type
     */
    public function type();
}
