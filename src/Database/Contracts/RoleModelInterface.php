<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\Role;
use Illuminate\Support\Collection as SupportCollection;

interface RoleModelInterface extends BaseInterface
{
    public function findAdminRole(): Role;

    public function options(): SupportCollection;
}
