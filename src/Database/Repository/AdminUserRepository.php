<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\AdminUser;
use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;

class AdminUserRepository extends BaseRepository implements AdminUserModelInterface
{
    protected $filterFields = [
        'first_name',
        'last_name',
        'email',
    ];

    protected $model;

    public function __construct()
    {
        $this->model = new AdminUser();
    }

    public function model(): AdminUser
    {
        return $this->model;
    }

    public function findByEmail(string $email): AdminUser
    {
        return AdminUser::whereEmail($email)->first();
    }
}
