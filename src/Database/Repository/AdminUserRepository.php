<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\AdminUser;
use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;

class AdminUserRepository implements AdminUserModelInterface
{
    /**
     * Create AdminUser Resource into a database
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\AdminUser $adminUser
     */
    public function create(array $data): AdminUser
    {
        return AdminUser::create($data);
    }
}
