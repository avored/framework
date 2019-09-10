<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\UserGroup;

interface UserGroupModelInterface
{
    /**
     * Create UserGroup Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\UserGroup $userGroup
     */
    public function create(array $data) : UserGroup;

    /**
     * get all user groups form the database.
     * @return \Illuminate\Database\Eloquent\Collection $userGroups
     */
    public function all() : Collection;

    /**
     * get default user group instance.
     * @return \AvoRed\Framework\Database\Models\UserGroup $userGroup
     */
    public function getIsDefault() : UserGroup;
}
