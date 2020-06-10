<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\UserGroup;
use AvoRed\Framework\Database\Contracts\UserGroupModelInterface;

class UserGroupRepository extends BaseRepository implements UserGroupModelInterface
{
    /**
     * @var UserGroup $model
     */
    protected $model;

    /**
     * Construct for the UserGroup Repository
     */
    public function __construct()
    {
        $this->model = new UserGroup();
    }

    /**
     * Get the model for the repository
     * @return UserGroup 
     */
    public function model(): UserGroup
    {
        return $this->model;
    }

    /**
     * get default user group instance.
     * @return \AvoRed\Framework\Database\Models\UserGroup $userGroup
     */
    public function getIsDefault() : UserGroup
    {
        return UserGroup::whereIsDefault(true)->first();
    }
}
