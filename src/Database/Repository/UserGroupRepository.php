<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\UserGroup;
use AvoRed\Framework\Database\Contracts\UserGroupModelInterface;
use Illuminate\Database\Eloquent\Collection;

class UserGroupRepository implements UserGroupModelInterface
{
    /**
     * Create UserGroup Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\UserGroup $userGroups
     */
    public function create(array $data): UserGroup
    {
        return UserGroup::create($data);
    }

    /**
     * get all user groups for
     * @return \Illuminate\Database\Eloquent\Collection $userGroups
     */
    public function all() : Collection
    {
        return UserGroup::all();
    }

    /**
     * get default user group instance
     * @return \AvoRed\Framework\Database\Models\UserGroup $userGroup
     */
    public function getIsDefault() : UserGroup
    {
        return UserGroup::whereIsDefault(true)->first();
    }
}
