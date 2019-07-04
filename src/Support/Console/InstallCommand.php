<?php

namespace AvoRed\Framework\Support\Console;

use Illuminate\Console\Command;
use AvoRed\Framework\Database\Repository\RoleRepository;
use AvoRed\Framework\Database\Models\Role;
use AvoRed\Framework\Database\Contracts\RoleModelInterface;
use AvoRed\Framework\Models\Contracts\AdminUserInterface;
use AvoRed\Framework\Database\Contracts\CurrencyModelInterface;

class InstallCommand extends Command
{
    /**
     * Role Repository for the Install Command
     * @var \AvoRed\Framework\Database\Repository\RoleRepository $roleRepository
     */
    protected $roleRepository;

    /**
     * Currency Repository for the Install Command
     * @var \AvoRed\Framework\Database\Repository\CurrencyRepository $currencyRepository
     */
    protected $currencyRepository;
    
    /**
     * Construct for the AvoRed install command
     * @param \AvoRed\Framework\Database\Contracts\RoleModelInterface $roleRepository
     * @param \AvoRed\Framework\Database\Contracts\CurrencyModelInterface $currencyRepository
     */
    public function __construct(
        RoleModelInterface $roleRepository,
        CurrencyModelInterface $currencyRepository
    ) {
        $this->roleRepository = $roleRepository;
        $this->currencyRepository = $currencyRepository;
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
        $absolutePath = __DIR__ .'/../../../database/migrations';
        $basePath = base_path();
        
        $relativePath = str_replace($basePath . '/', '', $absolutePath);

        $this->call('migrate:fresh', ['--path' => $relativePath]);
        $this->call('migrate');
        $this->call('avored:module:install', ['identifier' => 'avored-demodata']);
        $roleData = ['name' => Role::ADMIN];
        $this->roleRepository->create($roleData);
        $currencyData = $this->getCurrencyData();
        $this->currencyRepository->create($currencyData);
        $this->call('avored:admin:make');
        $this->info('AvoRed Install Successfully!');
    }

    /**
     * Get the Default currency data
     * @return array $currencyData
     */
    public function getCurrencyData()
    {
        return [
            'name' => 'US Dollar',
            'code' => 'usd',
            'symbol' => '$',
            'conversation_rate' => 1,
            'status' => 'ENABLED'
        ];
    }
}
