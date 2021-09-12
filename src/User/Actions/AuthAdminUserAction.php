<?php
namespace AvoRed\Framework\User\Actions;

use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;
use AvoRed\Framework\Database\Models\AdminUser;

final class AuthAdminUserAction
{
    /** @var \AvoRed\Framework\Database\Repository\AdminUserRepository */
    private $repository;

    public function __construct(AdminUserModelInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $email, string $password): AdminUser
    {
        $adminUser = $this->repository->findByEmail($email);
        //@todo validate password and return
        
        return $adminUser;
    }
}
