<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Address;

interface AddressModelInterface
{
    /**
     * Create Address Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Address $address
     */
    public function create(array $data) : Address;

    /**
     * Find Address Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Address $address
     */
    public function find(int $id) : Address;

    /**
     * Get All Addresses from Database via Customer Id.
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection $addresses
     */
    public function getByCustomerId(int $userId) : Collection;

    /**
     * Delete Address Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int;

    /**
     * Get All Address from the database.
     * @return \Illuminate\Database\Eloquent\Collection $addresses
     */
    public function all() : Collection;
}
