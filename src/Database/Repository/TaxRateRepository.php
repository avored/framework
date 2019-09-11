<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\TaxRate;
use AvoRed\Framework\Database\Contracts\TaxRateModelInterface;

class TaxRateRepository implements TaxRateModelInterface
{
    /**
     * Create TaxRate Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\TaxRate $taxRate
     */
    public function create(array $data): TaxRate
    {
        return TaxRate::create($data);
    }

    /**
     * get all user groups for.
     * @return \Illuminate\Database\Eloquent\Collection $taxRates
     */
    public function all() : Collection
    {
        return TaxRate::all();
    }
}
