<?php

namespace AvoRed\Framework\Support\Console;

use Illuminate\Console\Command;
use AvoRed\Framework\Database\Repository\RoleRepository;
use AvoRed\Framework\Database\Models\Role;
use AvoRed\Framework\Database\Contracts\RoleModelInterface;
use AvoRed\Framework\Models\Contracts\AdminUserInterface;

class InstallCommand extends Command
{
    /**
     * Role Repository for the Install Command
     * @var \AvoRed\Framework\Database\Repository\RoleRepository $roleRepository
     */
    protected $roleRepository;
    
    /**
     * Construct for the AvoRed install command
     * @param \AvoRed\Framework\Database\Repository\RoleRepository $roleRepository
     */
    public function __construct(
        RoleModelInterface $roleRepository
    ) {
        $this->roleRepository = $roleRepository;
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
        $roleData = ['name' => Role::ADMIN];
        $this->roleRepository->create($roleData);
        $this->info('AvoRed Install Successfully!');
    }
}
