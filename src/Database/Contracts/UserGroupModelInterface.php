<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\UserGroup;
use Illuminate\Database\Eloquent\Collection;

interface UserGroupModelInterface
{
    /**
     * Create UserGroup Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\UserGroup $userGroup
     */
    public function create(array $data) : UserGroup;

    /**
     * find roles for the users
     * @return \Illuminate\Database\Eloquent\Collection $userGroups
     */
    public function all() : Collection;
}
