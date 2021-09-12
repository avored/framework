<?php
namespace AvoRed\Framework\Support\Providers;

use AvoRed\Framework\System\Components\Form\Alert;
use AvoRed\Framework\System\Components\Form\Form;
use AvoRed\Framework\System\Components\Form\Input;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::component('avored-input', Input::class);
        Blade::component('avored-form', Form::class);
        Blade::component('avored-alert', Alert::class);
        // Blade::component('avored-table', Table::class);
        // Blade::component('avored-table-header', TableHeader::class);
        // Blade::component('avored-table-row', TableRow::class);
        // Blade::component('avored-table-cell', TableCell::class);


        // Livewire::component('avored-data-table', CategoryTableComponent::class);
    }
}
