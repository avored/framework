<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\AdminUser;
use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;

class AdminUserRepository implements AdminUserModelInterface
{
    /**
     * Create AdminUser Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\AdminUser $adminUser
     */
    public function create(array $data): AdminUser
    {
        return AdminUser::create($data);
    }

    /**
     * Find AdminUser by given Email in database.
     * @param string $email
     * @return \AvoRed\Framework\Database\Models\AdminUser $adminUser
     */
    public function findByEmail(string $email) : AdminUser
    {
        return AdminUser::whereEmail($email)->first();
    }

    /**
     * Get all the admin users from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $adminUsers
     */
    public function all() : Collection
    {
        return AdminUser::all();
    }
}
