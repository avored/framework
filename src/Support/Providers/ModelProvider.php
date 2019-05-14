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
        CategoryModelInterface::class => CategoryRepository::class,
        ConfigurationModelInterface::class => ConfigurationRepository::class,
        LanguageModelInterface::class => LanguageRepository::class,
        PermissionModelInterface::class => PermissionRepository::class,
        PageModelInterface::class => PageRepository::class,
        RoleModelInterface::class => RoleRepository::class,
        OrderStatusModelInterface::class => OrderStatusRepository::class,
        StateModelInterface::class => StateRepository::class,
        CountryModelInterface::class => CountryRepository::class,
        CurrencyModelInterface::class => CurrencyRepository::class,
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
