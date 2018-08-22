<?php

namespace AvoRed\Framework\Models;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Models\Contracts\ProductInterface;
use AvoRed\Framework\Models\Repository\ProductRepository;
use AvoRed\Framework\Models\Contracts\AttributeInterface;
use AvoRed\Framework\Models\Repository\AttributeRepository;
use AvoRed\Framework\Models\Repository\CategoryRepository;
use AvoRed\Framework\Models\Contracts\CategoryInterface;
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

class Provider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
    }

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
     * Register the Admin Menu instance.
     *
     * @return void
     */
    protected function registerModelContracts()
    {
        $this->app->bind(
            ProductInterface::class,
            ProductRepository::class
        );
        $this->app->bind(
            AttributeInterface::class,
            AttributeRepository::class
        );
        $this->app->bind(
            CategoryInterface::class,
            CategoryRepository::class
        );
        $this->app->bind(
            ConfigurationInterface::class,
            ConfigurationRepository::class
        );
        $this->app->bind(
            OrderInterface::class,
            OrderRepository::class
        );

        $this->app->bind(
            ProductDownloadableUrlInterface::class,
            ProductDownloadableUrlRepository::class
        );
        $this->app->bind(
            OrderHistoryInterface::class,
            OrderHistoryRepository::class
        );
        $this->app->bind(
            PropertyInterface::class,
            PropertyRepository::class
        );
        $this->app->bind(
            CategoryFilterInterface::class,
            CategoryFilterRepository::class
        );
        $this->app->bind(
            AdminUserInterface::class,
            AdminUserRepository::class
        );

       
        $this->app->bind(MenuInterface::class, MenuRepository::class);
        $this->app->bind(PageInterface::class, PageRepository::class);
        $this->app->bind(RoleInterface::class, RoleRepository::class);
        $this->app->bind(SiteCurrencyInterface::class, SiteCurrencyRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(UserGroupInterface::class, UserGroupRepository::class);
        //$this->app->bind(SiteCurrencyInterface::class, SiteCurrencyRepository::class);
    }
}
