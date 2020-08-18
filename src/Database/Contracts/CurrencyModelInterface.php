<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\Currency;

interface CurrencyModelInterface extends BaseInterface
{
    /**
     * Get default currency from the database.
     * @return \AvoRed\Framework\Database\Models\Currency $currency
     */
    public function getDefault() : Currency;
}
