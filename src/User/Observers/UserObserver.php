<?php

namespace AvoRed\Framework\User\Observers;

use AvoRed\Framework\Database\Contracts\CustomerGroupModelInterface;
use AvoRed\Framework\Database\Repository\CustomerGroupRepository;

class UserObserver
{
    /**
     * UserGroup Repository for controller.
     * @var CustomerGroupRepository
     */
    protected $customerGroupRepository;

    /**
     * Construct for the AvoRed user group controller.
     * @param CustomerGroupModelInterface $customerGroupRepository
     */
    public function __construct(
        CustomerGroupModelInterface $customerGroupRepository
    ) {
        $this->customerGroupRepository = $customerGroupRepository;
    }

    /**
     * Handle the User "created" event.
     *
     * @param mixed $customer
     * @return void
     */
    public function created($customer)
    {
        $customerGroup = $this->customerGroupRepository->getIsDefault();
        $customer->customer_group_id = $customerGroup->id;
        $customer->save();
    }
}
