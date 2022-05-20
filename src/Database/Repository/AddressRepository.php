<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Address;
use AvoRed\Framework\Database\Contracts\AddressModelInterface;

class AddressRepository extends BaseRepository implements AddressModelInterface
{
    /**
     * @var Address $model
     */
    protected $model;

    /**
     * Construct for the Address Repository
     */
    public function __construct()
    {
        $this->model = new Address();
    }

    /**
     * Get the model for the repository
     * @return Address
     */
    public function model(): Address
    {
        return $this->model;
    }


    /**
     * Get All Addresses from Database via User Id.
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection $addresses
     */
    public function getByCustomerId(int $userId): Collection
    {
        return Address::with('country')->whereCustomerId($userId)->get();
    }
}
