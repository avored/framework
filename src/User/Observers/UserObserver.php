<?php

namespace AvoRed\Framework\User\Observers;

use AvoRed\Framework\Database\Contracts\ConfigurationModelInterface;
use AvoRed\Framework\Database\Contracts\UserGroupModelInterface;
use AvoRed\Framework\Widget\TotalCustomer;

class UserObserver
{
    /**
     * UserGroup Repository for controller.
     * @var \AvoRed\Framework\Database\Repository\UserGroupRepository
     */
    protected $userGroupRepository;
    
    /**
     * Construct for the AvoRed user group controller.
     * @param \AvoRed\Framework\Database\Repository\UserGroupRepository $userGroupRepository
     */
    public function __construct(
        UserGroupModelInterface $userGroupRepository
    ) {
        $this->userGroupRepository = $userGroupRepository;
    }

    /**
     * Handle the User "created" event.
     *
     * @param mixed $user
     * @return void
     */
    public function created($user)
    {
        $userGroup = $this->userGroupRepository->getIsDefault();
        $user->user_group_id = $userGroup->id;
        $user->save();
    }
}
