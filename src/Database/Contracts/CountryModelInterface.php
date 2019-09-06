<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Support\Collection;

interface CountryModelInterface
{
    /**
     * Get All Country Options from the database.
     * @return \Illuminate\Support\Collection $categories
     */
    public function options() : Collection;
}
