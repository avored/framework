<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Support\Collection;
use AvoRed\Framework\Database\Models\Country;
use AvoRed\Framework\Database\Contracts\CountryModelInterface;

class CountryRepository implements CountryModelInterface
{
    /**
     * Get all the country options from the connected database.
     * @return \Illuminate\Support\Collection $countryOptions
     */
    public function options() : Collection
    {
        return Country::all()->pluck('name', 'id');
    }

    /**
     * Get all the country options from the connected database.
     * @return \Illuminate\Support\Collection $countryOptions
     */
    public function currencyCodeOptions() : Collection
    {
        return Country::all()
            ->pluck('currency_code', 'currency_code')
            ;
    }

    /**
     * Get all the country options from the connected database.
     * @return \Illuminate\Support\Collection $countryOptions
     */
    public function currencySymbolOptions() : Collection
    {
        return Country::all()->pluck('currency_symbol')->unique();
    }
}
