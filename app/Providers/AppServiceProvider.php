<?php

namespace App\Providers;

use App\Domain\Product\Models\Product;
use App\Events\ProductActionEvent;
use App\Events\UserActionEvent;
use App\Listeners\ProductActionListener;
use App\Listeners\UserActionListener;
use App\Models\User;
use App\Observers\ProductObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Product::observe(ProductObserver::class);
        Event::listen(
            UserActionEvent::class,
            UserActionListener::class,
            ProductActionEvent::class,
            ProductActionListener::class,
        );
    }
}
