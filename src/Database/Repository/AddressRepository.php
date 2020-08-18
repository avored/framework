<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Address;
use AvoRed\Framework\Database\Contracts\AddressModelInterface;

class AddressRepository implements AddressModelInterface
{
    /**
     * Create Address Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Address $address
     */
    public function create(array $data): Address
    {
        return Address::create($data);
    }

    /**
     * Find Address Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Address $address
     */
    public function find(int $id): Address
    {
        return Address::find($id);
    }

    /**
     * Delete Address Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return Address::destroy($id);
    }

    /**
     * Get all the addresses from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $addresses
     */
    public function all() : Collection
    {
        return Address::all();
    }

    /**
     * Get All Addresses from Database via User Id.
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection $addresses
     */
    public function getByCustomerId(int $userId) : Collection
    {
        return Address::with('country')->whereCustomerId($userId)->get();
    }
}
