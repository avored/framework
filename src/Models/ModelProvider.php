<?php

namespace AvoRed\Framework\Models;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Models\Contracts\ProductInterface;
use AvoRed\Framework\Models\Repository\ProductRepository;
use AvoRed\Framework\Models\Contracts\AttributeInterface;
use AvoRed\Framework\Models\Repository\AttributeRepository;
use AvoRed\Framework\Models\Contracts\CategoryInterface;
use AvoRed\Framework\Models\Repository\CategoryRepository;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;
use AvoRed\Framework\Models\Repository\ConfigurationRepository;
use AvoRed\Framework\Models\Contracts\OrderInterface;
use AvoRed\Framework\Models\Repository\OrderRepository;
use AvoRed\Framework\Models\Contracts\ProductDownloadableUrlInterface;
use AvoRed\Framework\Models\Repository\ProductDownloadableUrlRepository;
use AvoRed\Framework\Models\Repository\OrderHistoryRepository;
use AvoRed\Framework\Models\Contracts\OrderHistoryInterface;
use AvoRed\Framework\Models\Repository\PropertyRepository;
use AvoRed\Framework\Models\Contracts\PropertyInterface;
use AvoRed\Framework\Models\Repository\CategoryFilterRepository;
use AvoRed\Framework\Models\Contracts\CategoryFilterInterface;
use AvoRed\Framework\Models\Repository\AdminUserRepository;
use AvoRed\Framework\Models\Contracts\AdminUserInterface;
use AvoRed\Framework\Models\Contracts\MenuInterface;
use AvoRed\Framework\Models\Repository\MenuRepository;
use AvoRed\Framework\Models\Contracts\MenuGroupInterface;
use AvoRed\Framework\Models\Repository\MenuGroupRepository;
use AvoRed\Framework\Models\Contracts\PageInterface;
use AvoRed\Framework\Models\Repository\PageRepository;
use AvoRed\Framework\Models\Contracts\RoleInterface;
use AvoRed\Framework\Models\Repository\RoleRepository;
use AvoRed\Framework\Models\Contracts\SiteCurrencyInterface;
use AvoRed\Framework\Models\Repository\SiteCurrencyRepository;
use AvoRed\Framework\Models\Contracts\UserInterface;
use AvoRed\Framework\Models\Repository\UserRepository;
use AvoRed\Framework\Models\Contracts\UserGroupInterface;
use AvoRed\Framework\Models\Repository\UserGroupRepository;
use AvoRed\Framework\Models\Contracts\CountryInterface;
use AvoRed\Framework\Models\Repository\CountryRepository;
use AvoRed\Framework\Models\Contracts\StateInterface;
use AvoRed\Framework\Models\Repository\StateRepository;
use AvoRed\Framework\Models\Contracts\OrderStatusInterface;
use AvoRed\Framework\Models\Repository\OrderStatusRepository;
use AvoRed\Framework\Models\Contracts\OrderReturnRequestInterface;
use AvoRed\Framework\Models\Repository\OrderReturnRequestRepository;
use AvoRed\Framework\Models\Contracts\OrderReturnProductInterface;
use AvoRed\Framework\Models\Repository\OrderReturnProductRepository;

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
        AdminUserInterface::class => AdminUserRepository::class,
        AttributeInterface::class => AttributeRepository::class,
        CategoryInterface::class => CategoryRepository::class,
        CategoryFilterInterface::class => CategoryFilterRepository::class,
        ConfigurationInterface::class => ConfigurationRepository::class,
        CountryInterface::class => CountryRepository::class,
        MenuInterface::class => MenuRepository::class,
        MenuGroupInterface::class => MenuGroupRepository::class,
        OrderInterface::class => OrderRepository::class,
        OrderHistoryInterface::class => OrderHistoryRepository::class,
        OrderReturnProductInterface::class => OrderReturnProductRepository::class,
        OrderReturnRequestInterface::class => OrderReturnRequestRepository::class,
        OrderStatusInterface::class => OrderStatusRepository::class,
        PageInterface::class => PageRepository::class,
        ProductInterface::class => ProductRepository::class,
        ProductDownloadableUrlInterface::class => ProductDownloadableUrlRepository::class,
        PropertyInterface::class => PropertyRepository::class,
        RoleInterface::class => RoleRepository::class,
        SiteCurrencyInterface::class => SiteCurrencyRepository::class,
        StateInterface::class => StateRepository::class,
        UserInterface::class => UserRepository::class,
        UserGroupInterface::class => UserGroupRepository::class,
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
