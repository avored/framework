<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\TaxGroup;
use Illuminate\Database\Eloquent\Collection;

interface TaxGroupModelInterface
{
    /**
     * Create TaxGroup Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\TaxGroup $taxGroup
     */
    public function create(array $data) : TaxGroup;

    /**
     * find roles for the users
     * @return \Illuminate\Database\Eloquent\Collection $taxGroups
     */
    public function all() : Collection;
}
