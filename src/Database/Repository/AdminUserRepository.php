<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\AdminUser;
use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;

class AdminUserRepository extends BaseRepository implements AdminUserModelInterface
{
    /**
     * @var AdminUser $model
     */
    protected $model;

    /**
     * Construct for the AdminUser Repository
     */
    public function __construct()
    {
        $this->model = new AdminUser();
    }

    /**
     * Get the model for the repository
     * @return AdminUser 
     */
    public function model(): AdminUser
    {
        return $this->model;
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
}
