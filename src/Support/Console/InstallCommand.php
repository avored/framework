<?php

namespace AvoRed\Framework\Support\Console;

use AvoRed\Framework\AvoRedProvider;
use AvoRed\Framework\Database\Contracts\ConfigurationModelInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use AvoRed\Framework\Database\Models\Role;
use AvoRed\Framework\Database\Contracts\RoleModelInterface;
use AvoRed\Framework\Database\Contracts\CurrencyModelInterface;
use AvoRed\Framework\Database\Contracts\LanguageModelInterface;
use AvoRed\Framework\Database\Contracts\CustomerGroupModelInterface;
use AvoRed\Framework\Database\Contracts\OrderStatusModelInterface;

class InstallCommand extends Command
{
    /**
     * Role Repository for the Install Command.
     * @var \AvoRed\Framework\Database\Repository\RoleRepository
     */
    protected $roleRepository;

    /**
     * OrderStauts Repository for the Install Command.
     * @var \AvoRed\Framework\Database\Repository\OrderStatusRepository
     */
    protected $orderStatusRepository;

    /**
     * UserGroup Repository for the Install Command.
     * @var \AvoRed\Framework\Database\Repository\UserGroupRepository
     */
    protected $customerGroupRepository;

    /**
     * Currency Repository for the Install Command.
     * @var \AvoRed\Framework\Database\Repository\CurrencyRepository
     */
    protected $currencyRepository;

    /**
     * Currency Repository for the Install Command.
     * @var \AvoRed\Framework\Database\Repository\LanguageRepository
     */
    protected $languageRepository;
    /**
     * Configuration Repository for the Install Command.
     * @var \AvoRed\Framework\Database\Repository\LanguageRepository
     */
    protected $configurationRepository;

    /**
     * Construct for the AvoRed install command.
     * @param \AvoRed\Framework\Database\Contracts\RoleModelInterface $roleRepository
     * @param \AvoRed\Framework\Database\Contracts\CurrencyModelInterface $currencyRepository
     * @param \AvoRed\Framework\Database\Contracts\LanguageModelInterface $languageRepository
     * @param \AvoRed\Framework\Database\Contracts\CustomerGroupModelInterface $customerGroupRepository
     * @param \AvoRed\Framework\Database\Contracts\OrderStatusModelInterface $orderStatusRepository
     * @param \AvoRed\Framework\Database\Contracts\ConfigurationModelInterface $configurationRepository
     */
    public function __construct(
        RoleModelInterface $roleRepository,
        CurrencyModelInterface $currencyRepository,
        LanguageModelInterface $languageRepository,
        CustomerGroupModelInterface $customerGroupRepository,
        OrderStatusModelInterface $orderStatusRepository,
        ConfigurationModelInterface $configurationRepository
    ) {
        $this->roleRepository = $roleRepository;
        $this->currencyRepository = $currencyRepository;
        $this->languageRepository = $languageRepository;
        $this->customerGroupRepository = $customerGroupRepository;
        $this->orderStatusRepository = $orderStatusRepository;
        $this->configurationRepository = $configurationRepository;
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
        
        $roleData = ['name' => Role::ADMIN];
        $this->roleRepository->create($roleData);
        $this->createCurrency();
        $this->createLanguage();
        $this->createDefaultUserGroup();
        $this->createOrderStatus();
        $this->alterUserTable();

        if ($this->confirm('Would you like to install Dummy Data?')) {
            $this->call('avored:module:install', ['identifier' => 'avored-demodata']);
        }
        $this->call('avored:admin:make');
        $this->call('vendor:publish', ['--provider' => AvoRedProvider::class]);

        $this->info('AvoRed Install Successfully!');
    }

    /**
     * Get the Default currency data.
     * @return void
     */
    public function createCurrency()
    {
        $data = [
            'name' => 'US Dollar',
            'code' => 'usd',
            'symbol' => '$',
            'conversation_rate' => 1,
            'status' => 'ENABLED',
        ];
        $currency = $this->currencyRepository->create($data);
        $this->configurationRepository->create([
            'code' => 'default_currency',
            'value' => $currency->id
        ]);
    }

    /**
     * Get the Default currency data.
     * @return void
     */
    public function createDefaultUserGroup()
    {
        $data = [
            'name' => 'Default Group',
            'is_default' => 1,
        ];
        $this->customerGroupRepository->create($data);
    }

    /**
     * create order status.
     * @return void
     */
    public function createOrderStatus()
    {
        $defaultStatus = $this->orderStatusRepository->create(['name' => 'Pending']);
        $defaultStatus->is_default = 1;
        $defaultStatus->save();
        $this->orderStatusRepository->create(['name' => 'Processing']);
        $this->orderStatusRepository->create(['name' => 'Completed']);
    }

    /**
     * Get the Language data.
     * @return void
     */
    public function createLanguage()
    {
        $data = [
            'name' => 'English',
            'code' => 'en',
            'is_default' => 1,
        ];
        $this->languageRepository->create($data);
    }

    /**
     * Alter User Table for user group id.
     * @return void
     */
    public function alterUserTable()
    {
        $user = config('avored.model.user');

        try {
            $model = resolve($user);
        } catch (\Exception $e) {
            $model = null;
        }

        if ($model !== null) {
            $table = $model->getTable();
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $table) {
                    $table->unsignedBigInteger('customer_group_id')->nullable()->default(null);
                });
            }
        }
    }
}
