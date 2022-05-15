<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\AdminUser;

interface AdminUserModelInterface extends BaseInterface
{
    public function findByEmail(string $email): AdminUser;
}
