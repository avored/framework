<?php

namespace AvoRed\Framework\System\Console;

use AvoRed\Framework\Database\Contracts\RoleModelInterface;
use AvoRed\Framework\User\Actions\CreateAdminUserAction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AdminMakeCommand extends Command
{
    /** @var \AvoRed\Framework\User\Actions\CreateAdminUserAction */
    private $createAdminUserAction;

    /** @var \AvoRed\Framework\Database\Repository\RoleRepository */
    private $roleRepository;

    public function __construct(
        CreateAdminUserAction $action,
        RoleModelInterface $repository
    ) {
        $this->createAdminUserAction = $action;
        $this->roleRepository = $repository;
        parent::__construct();
    }


    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'avored:admin:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'AvoRed create an admin user account';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $data['first_name'] = $this->ask('What is your First Name?');
        $data['last_name'] = $this->ask('What is your last Name?');
        $data['email'] = $this->ask('What is your Email Address?');
        $data['password'] = $this->secret('What is your Password?');
        $data['confirm_password'] = $this->secret('Confirm your password again?');

        $role = $this->roleRepository->findAdminRole();
        $data['role_id'] = $role->id;
        $data['is_super_admin'] = 1;
        $data['password'] = Hash::make($data['password']);

        $this->createAdminUserAction->handle($data);

        $this->info('Admin User created Successfully!');
    }
}
