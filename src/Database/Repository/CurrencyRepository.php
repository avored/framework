<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Currency;
use AvoRed\Framework\Database\Contracts\CurrencyModelInterface;

class CurrencyRepository implements CurrencyModelInterface
{
    /**
     * Create Currency Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Currency $currency
     */
    public function create(array $data): Currency
    {
        return Currency::create($data);
    }

    /**
     * Find Currency Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Currency $currency
     */
    public function find(int $id): Currency
    {
        return Currency::find($id);
    }

    /**
     * Delete Currency Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return Currency::destroy($id);
    }

    /**
     * Get all the categories from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $currencies
     */
    public function all() : Collection
    {
        return Currency::all();
    }
}
