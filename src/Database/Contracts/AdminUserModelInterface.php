<?php

namespace AvoRed\Framework\Database\Contracts;

use AvoRed\Framework\Database\Models\AdminUser;

interface AdminUserModelInterface
{
    /**
     * Create AdminUser Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\AdminUser $adminUser
     */
    public function create(array $data) : AdminUser;
}
