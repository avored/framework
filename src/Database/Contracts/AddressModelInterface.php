<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Address;

interface AddressModelInterface extends BaseInterface
{
    /**
     * Get All Addresses from Database via Customer Id.
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection $addresses
     */
    public function getByCustomerId(int $userId) : Collection;

}