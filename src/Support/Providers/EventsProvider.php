<?php

namespace AvoRed\Framework\Support\Providers;

use AvoRed\Framework\Order\Events\OrderProductCreated;
use AvoRed\Framework\Order\Listeners\OrderProductCreatedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventsProvider extends ServiceProvider
{
    /**
    * The event listener mappings for the application.
    *
    * @var array
    */
    protected $listen = [
        OrderProductCreated::class => [
            OrderProductCreatedListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        // $this->registerUserModelObserver();
    }
}
