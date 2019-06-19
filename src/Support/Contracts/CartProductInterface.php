<?php

namespace AvoRed\Framework\Support\Contracts;

interface CartProductInterface
{
    /**
     * Get/Set CartProduct name.
     * @return mixed $name|$this
     */
    public function name();

    /**
     * Get/Set CartProduct Slug.
     * @return mixed $slug|$this
     */
    public function slug();

    /**
     * Get/Set CartProduct Qty.
     * @return mixed $qty|$this
     */
    public function qty();

    /**
     * Get/Set CartProduct total.
     * @return float $total
     */
    public function total(): float;
}
