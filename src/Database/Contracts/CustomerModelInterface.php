<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Customer;

interface CustomerModelInterface extends BaseInterface
{

    /**
     * Find Customer by given Email in database.
     * @param string $email
     * @return \AvoRed\Framework\Database\Models\Customer $customer
     */
    public function findByEmail(string $email) : ?Customer;
}
