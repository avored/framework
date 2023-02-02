<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Support\Collection;

interface PropertyModelInterface extends BaseInterface
{

    /**
     * Get all the properties which should apply to all the products.
     * @param int $perPage
     * @return \Illuminate\Support\Collection $products
     */
    public function getAllProductProperties(): Collection;
}
