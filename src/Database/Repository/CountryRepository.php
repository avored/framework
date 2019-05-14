<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Country;
use AvoRed\Framework\Database\Contracts\CountryModelInterface;
use Illuminate\Support\Collection;

class CountryRepository implements CountryModelInterface
{
    /**
     * Get all the country options from the connected database
     * @return \Illuminate\Support\Collection $countryOptions
     */
    public function options() : Collection
    {
        return Country::all()->pluck('name', 'id');
    }
}
