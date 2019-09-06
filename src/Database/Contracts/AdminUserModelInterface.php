<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\AdminUser;

interface AdminUserModelInterface
{
    /**
     * Create AdminUser Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\AdminUser $adminUser
     */
    public function create(array $data) : AdminUser;

    /**
     * Find AdminUser by given Email in database.
     * @param string $email
     * @return \AvoRed\Framework\Database\Models\AdminUser $adminUser
     */
    public function findByEmail(string $email) : AdminUser;

    /**
     * Get all the admin users from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $adminUsers
     */
    public function all() : Collection;
}
