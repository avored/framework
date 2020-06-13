<?php

namespace AvoRed\Framework\Support\Providers;

use AvoRed\Framework\Database\Models\Order;
use AvoRed\Framework\Order\Events\OrderProductCreated;
use AvoRed\Framework\Order\Listeners\OrderProductCreatedListener;
use AvoRed\Framework\Order\Observers\OrderObserver;
use AvoRed\Framework\User\Observers\UserObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
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
        $this->registerUserModelObserver();
    }

    /**
     * Register User Created Event Listener.
     * @return void
     */
    public function registerUserModelObserver()
    {
        $user = config('avored.model.user');

        try {
            $model = app($user);
        } catch (\Exception $e) {
            $model = null;
        }
       
        if ($model !== null) {
            $model->observe(UserObserver::class);
        }

        Order::observe(OrderObserver::class);
    }
}
