<?php
namespace AvoRed\Framework\User\Actions;

use AvoRed\Framework\Database\Contracts\RoleModelInterface;
use AvoRed\Framework\Database\Models\Role;

final class CreateRoleAction
{
    /** @var \AvoRed\Framework\Database\Repository\RoleRepository */
    private $repository;

    public function __construct(RoleModelInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(array $data): Role
    {
        return $this->repository->create($data);
    }
}
