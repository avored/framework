<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Currency;

interface CurrencyModelInterface
{
    /**
     * Create Currency Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Currency $currency
     */
    public function create(array $data) : Currency;

    /**
     * Find Currency Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Currency $currency
     */
    public function find(int $id) : Currency;

    /**
     * Delete Currency Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;

    /**
     * Get All Currency from the database.
     * @return \Illuminate\Database\Eloquent\Collection $currencies
     */
    public function all() : Collection;
}
