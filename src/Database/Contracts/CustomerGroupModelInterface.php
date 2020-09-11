<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\CustomerGroup;

interface CustomerGroupModelInterface extends BaseInterface
{
    /**
     * get default user group instance.
     * @return \AvoRed\Framework\Database\Models\CustomerGroup $userGroup
     */
    public function getIsDefault() : ?CustomerGroup;
}
