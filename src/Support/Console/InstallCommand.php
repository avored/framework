<?php

namespace AvoRed\Framework\Support\Console;

use Illuminate\Console\Command;
use AvoRed\Framework\Database\Repository\RoleRepository;
use AvoRed\Framework\Database\Models\Role;
use AvoRed\Framework\Database\Contracts\RoleModelInterface;
use AvoRed\Framework\Models\Contracts\AdminUserInterface;
use AvoRed\Framework\Database\Contracts\CurrencyModelInterface;
use AvoRed\Framework\Database\Contracts\LanguageModelInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

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
     * Currency Repository for the Install Command
     * @var \AvoRed\Framework\Database\Repository\LanguageRepository $languageRepository
     */
    protected $languageRepository;
    
    /**
     * Construct for the AvoRed install command
     * @param \AvoRed\Framework\Database\Contracts\RoleModelInterface $roleRepository
     * @param \AvoRed\Framework\Database\Contracts\CurrencyModelInterface $currencyRepository
     * @param \AvoRed\Framework\Database\Contracts\LanguageModelInterface $languageRepository
     */
    public function __construct(
        RoleModelInterface $roleRepository,
        CurrencyModelInterface $currencyRepository,
        LanguageModelInterface $languageRepository
    ) {
        $this->roleRepository = $roleRepository;
        $this->currencyRepository = $currencyRepository;
        $this->languageRepository = $languageRepository;
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

        $this->call('migrate', ['--path' => $relativePath]);
        //$this->call('migrate');
        //$this->call('avored:module:install', ['identifier' => 'avored-demodata']);
        $roleData = ['name' => Role::ADMIN];
        $this->roleRepository->create($roleData);
        $this->createCurrency();
        $this->createLanguage();
        $this->alterUserTable();
        
        //$this->call('avored:admin:make');
        $this->info('AvoRed Install Successfully!');
    }

    /**
     * Get the Default currency data
     * @return void
     */
    public function createCurrency()
    {
        $data =  [
            'name' => 'US Dollar',
            'code' => 'usd',
            'symbol' => '$',
            'conversation_rate' => 1,
            'status' => 'ENABLED'
        ];
        $this->currencyRepository->create($data);
    }

    /**
     * Get the Language data
     * @return void
     */
    public function createLanguage()
    {
        $data =  [
            'name' => 'English',
            'code' => 'en',
            'is_default' => 1
        ];
        $this->languageRepository->create($data);
    }

    /**
     * Alter User Table for user group id
     * @return void
     */
    public function alterUserTable()
    {
        $user =  config('avored.model.user');

        try {
            $model = resolve($user);
        } catch (\Exception $e) {
            $model = null;
        }

        if ($model !== null) {
            $table = $model->getTable();
            Schema::table($table, function (Blueprint $table) {
                $table->unsignedBigInteger('user_group_id')->nullable()->default(null);
            });
        }
    }
}
