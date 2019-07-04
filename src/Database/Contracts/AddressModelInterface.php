<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\Address;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

interface AddressModelInterface
{
    /**
     * Create Address Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Address $address
     */
    public function create(array $data) : Address;

    /**
     * Find Address Resource into a database
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Address $address
     */
    public function find(int $id) : Address;

    /**
     * Get All Addresses from Database via User Id
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection $addresses
     */
    public function getByUserId(int $userId) : Collection;

    /**
     * Delete Address Resource from a database
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool;

    /**
     * Get All Address from the database
     * @return \Illuminate\Database\Eloquent\Collection $addresses
     */
    public function all() : Collection;
}
