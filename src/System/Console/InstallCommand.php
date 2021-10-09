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

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'avored:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install AvoRed e commerce an Laravel Shopping Cart';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->call('migrate:fresh');
        $this->call('storage:link');
        $this->createRoleAction->handle(['name' => Role::ADMIN]);
        $this->call('avored:admin:make');

        $this->info('AvoRed Install Successfully!');
    }
}
