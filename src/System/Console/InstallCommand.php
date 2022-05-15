<?php

namespace AvoRed\Framework\System\Console;

use AvoRed\Framework\Database\Models\Role;
use AvoRed\Framework\User\Actions\CreateRoleAction;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /** @var \AvoRed\Framework\User\Actions\CreateRoleAction */
    private $createRoleAction;

    public function __construct(
        CreateRoleAction $action
    ) {
        $this->createRoleAction = $action;
        parent::__construct();
    }

    protected $name = 'avored:install';

    protected $description = 'Install AvoRed e commerce an Laravel Shopping Cart';

    public function handle()
    {
        $this->call('migrate:fresh');
        $this->executePassportInstallCommand();
        $this->call('storage:link');
        $this->createRoleAction->handle(['name' => Role::ADMIN]);

        if ($this->confirm('Would you like to install Dummy Data?')) {
            // $this->call('avored:module:install', ['identifier' => 'avored-dummy-data']);
        }

        $this->call('avored:admin:make');

        $this->info('AvoRed Install Successfully!');
    }

    public function executePassportInstallCommand()
    {
        $provider = 'customers';

        // $this->call('passport:keys');
        // $this->call('passport:keys', ['--force' => true]);

        // $this->call('passport:client', ['--personal' => true, '--name' => config('app.name') . ' Personal Access Client']);
        // $this->call('passport:client', ['--password' => true, '--name' => config('app.name') . ' Password Grant Client', '--provider' => $provider]);
    }
}
