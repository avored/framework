<?php


namespace AvoRed\Framework\Support\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeProvider extends ServiceProvider
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
        Blade::directive('currency', function ($value){
            return "<?php echo number_format($value, 2); ?>";
        });
    }
}
