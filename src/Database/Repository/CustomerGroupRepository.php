<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\CustomerGroup;
use AvoRed\Framework\Database\Contracts\CustomerGroupModelInterface;

class CustomerGroupRepository extends BaseRepository implements CustomerGroupModelInterface
{
    /**
     * @var CustomerGroup $model
     */
    protected $model;

    /**
     * Construct for the CustomerGroup Repository
     */
    public function __construct()
    {
        $this->model = new CustomerGroup();
    }

    /**
     * Get the model for the repository
     * @return CustomerGroup 
     */
    public function model(): CustomerGroup
    {
        return $this->model;
    }

    /**
     * get default user group instance.
     * @return \AvoRed\Framework\Database\Models\CustomerGroup $userGroup
     */
    public function getIsDefault() : ?CustomerGroup
    {
        return CustomerGroup::whereIsDefault(true)->first();
    }
}
