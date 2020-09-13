<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Support\Collection;
use AvoRed\Framework\Database\Models\Customer;
use AvoRed\Framework\Database\Contracts\CustomerModelInterface;
use Carbon\Carbon;

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

    /**
     * Find New Customer by given parameter in database.
     * @param string $from
     * @param string $to
     * @param string $groupBy
     * @return \Illuminate\Support\Collection $customers
     */
    public function getNewCustomersBy($from, $to, $groupBy) : Collection
    {
        return $this->model->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to)
            ->orderBy('created_at')
            ->get()
            ->groupBy(function($customer)  use ($groupBy) {
                switch ($groupBy) {
                    case "DAY" :
                        return Carbon::parse($customer->created_at)->format('d-M-Y');
                    break;
                    case "WEEK" :
                        return $customer->created_at->startOfWeek()->format('d-M-Y') . ':'. $customer->created_at->endOfWeek()->format('d-M-Y');
                    break;
                    case "MONTH" :
                        return Carbon::parse($customer->created_at)->format('M-Y');
                    break;
                    case "YEAR" :
                        return Carbon::parse($customer->created_at)->format('Y');
                    break;
                }
        });
    }
}
