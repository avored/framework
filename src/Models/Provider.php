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
    }
}
