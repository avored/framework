<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Customer;
use AvoRed\Framework\Database\Contracts\CustomerModelInterface;

class CustomerRepository extends BaseRepository implements CustomerModelInterface
{
    /**
     * @var Customer $model
     */
    protected $model;

    /**
     * Construct for the Customer Repository
     */
    public function __construct()
    {
        $this->model = new Customer();
    }

    /**
     * Get the model for the repository
     * @return Customer 
     */
    public function model(): Customer
    {
        return $this->model;
    }

    /**
     * Find Customer by given Email in database.
     * @param string $email
     * @return \AvoRed\Framework\Database\Models\Customer $adminUser
     */
    public function findByEmail(string $email) : ?Customer
    {
        return Customer::whereEmail($email)->first();
    }
}
