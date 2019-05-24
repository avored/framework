<?php

namespace AvoRed\Framework\Support\Providers;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Support\Facades\Module;
use AvoRed\Framework\Modules\Manager;
use AvoRed\Framework\Database\Contracts\RoleModelInterface;
use AvoRed\Framework\Database\Repository\RoleRepository;
use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;
use AvoRed\Framework\Database\Repository\AdminUserRepository;
use AvoRed\Framework\Database\Contracts\LanguageModelInterface;
use AvoRed\Framework\Database\Repository\LanguageRepository;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use AvoRed\Framework\Database\Repository\CategoryRepository;
use AvoRed\Framework\Database\Contracts\PermissionModelInterface;
use AvoRed\Framework\Database\Repository\PermissionRepository;
use AvoRed\Framework\Database\Contracts\PageModelInterface;
use AvoRed\Framework\Database\Repository\PageRepository;
use AvoRed\Framework\Database\Contracts\MenuModelInterface;
use AvoRed\Framework\Database\Repository\MenuRepository;
use AvoRed\Framework\Database\Contracts\ConfigurationModelInterface;
use AvoRed\Framework\Database\Repository\ConfigurationRepository;
use AvoRed\Framework\Database\Contracts\OrderStatusModelInterface;
use AvoRed\Framework\Database\Repository\OrderStatusRepository;
use AvoRed\Framework\Database\Contracts\StateModelInterface;
use AvoRed\Framework\Database\Repository\StateRepository;
use AvoRed\Framework\Database\Contracts\CountryModelInterface;
use AvoRed\Framework\Database\Repository\CountryRepository;
use AvoRed\Framework\Database\Contracts\CurrencyModelInterface;
use AvoRed\Framework\Database\Repository\CurrencyRepository;
use AvoRed\Framework\Database\Contracts\PropertyModelInterface;
use AvoRed\Framework\Database\Repository\PropertyRepository;
use AvoRed\Framework\Database\Contracts\AttributeModelInterface;
use AvoRed\Framework\Database\Repository\AttributeRepository;
use AvoRed\Framework\Database\Contracts\UserGroupModelInterface;
use AvoRed\Framework\Database\Repository\UserGroupRepository;
use AvoRed\Framework\Database\Contracts\TaxGroupModelInterface;
use AvoRed\Framework\Database\Repository\TaxGroupRepository;
use AvoRed\Framework\Database\Contracts\TaxRateModelInterface;
use AvoRed\Framework\Database\Repository\TaxRateRepository;

class ModelProvider extends ServiceProvider
{
     /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    /**
     * Models Array list to bind with It's Contact
     * @var array $models
     */
    protected $models = [
        AdminUserModelInterface::class => AdminUserRepository::class,
        AttributeModelInterface::class => AttributeRepository::class,
        CategoryModelInterface::class => CategoryRepository::class,
        ConfigurationModelInterface::class => ConfigurationRepository::class,
        CountryModelInterface::class => CountryRepository::class,
        CurrencyModelInterface::class => CurrencyRepository::class,
        LanguageModelInterface::class => LanguageRepository::class,
        OrderStatusModelInterface::class => OrderStatusRepository::class,
        PermissionModelInterface::class => PermissionRepository::class,
        PageModelInterface::class => PageRepository::class,
        MenuModelInterface::class => MenuRepository::class,
        PropertyModelInterface::class => PropertyRepository::class,
        RoleModelInterface::class => RoleRepository::class,
        StateModelInterface::class => StateRepository::class,
        UserGroupModelInterface::class => UserGroupRepository::class,
        TaxGroupModelInterface::class => TaxGroupRepository::class,
        TaxRateModelInterface::class => TaxRateRepository::class,
    ];
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerModelContracts();
    }
    /**
     * Bind The Eloquent Model with their contract.
     *
     * @return void
     */
    protected function registerModelContracts()
    {
        foreach ($this->models as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }
}
