<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\UserGroup;

interface UserGroupModelInterface extends BaseInterface
{
    /**
     * get default user group instance.
     * @return \AvoRed\Framework\Database\Models\UserGroup $userGroup
     */
    public function getIsDefault() : UserGroup;
}
