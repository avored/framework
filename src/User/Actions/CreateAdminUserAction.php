<?php

namespace AvoRed\Framework\User\Actions;

use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;
use AvoRed\Framework\Database\Models\AdminUser;

final class CreateAdminUserAction
{
    /** @var \AvoRed\Framework\Database\Repository\AdminUserRepository */
    private $repository;

    public function __construct(AdminUserModelInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(array $data): AdminUser
    {
        return $this->repository->create($data);
    }
}
