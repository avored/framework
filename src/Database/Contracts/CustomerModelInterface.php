<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\Customer;
use Illuminate\Support\Collection;

interface CustomerModelInterface extends BaseInterface
{

    /**
     * Find Customer by given Email in database.
     * @param string $email
     * @return \AvoRed\Framework\Database\Models\Customer $customer
     */
    public function findByEmail(string $email) : ?Customer;

    /**
     * Find New Customer by given parameter in database.
     * @param string $from
     * @param string $to
     * @param string $groupBy
     * @return \Illuminate\Support\Collection $customers
     */
    public function getNewCustomersBy($from, $to, $groupBy) : Collection;
}
