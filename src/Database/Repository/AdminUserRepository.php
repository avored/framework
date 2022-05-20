<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;
use AvoRed\Framework\Database\Models\AdminUser;

class AdminUserRepository extends BaseRepository implements AdminUserModelInterface
{
    /**
     * Filterable Fields
     * @var array
     */
    protected $filterFields = [
        'first_name',
        'last_name',
        'email',
    ];

    /**
     * @var AdminUser
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
    public function findByEmail(string $email): AdminUser
    {
        return AdminUser::whereEmail($email)->first();
    }
}
