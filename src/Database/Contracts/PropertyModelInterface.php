<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface PropertyModelInterface extends BaseInterface
{
    /**
     * Get All Property to use in product.
     * @return \Illuminate\Database\Eloquent\Collection $properties
     */
    public function allPropertyToUseInProduct(): Collection;
}
