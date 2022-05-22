<?php

namespace AvoRed\Framework\Support\Providers;

use AvoRed\Framework\System\Components\Livewire\ProductImage;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class ComponentsProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        $this->registerBlades();
    }

    public function registerBlades()
    {
        Blade::componentNamespace('AvoRed\\Framework\\System\\Components', 'avored');

        Livewire::component('avored-product-images', ProductImage::class);
    }
}
