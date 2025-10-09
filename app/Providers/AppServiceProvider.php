<?php

namespace App\Providers;

use App\Domain\Material\Models\Material;
use App\Domain\Payment\Models\Payment;
use App\Domain\Product\Models\Product;
use App\Events\MaterialActionEvent;
use App\Events\PaymentActionEvent;
use App\Events\ProductActionEvent;
use App\Events\UserActionEvent;
use App\Listeners\MaterialActionListener;
use App\Listeners\PaymentActionListener;
use App\Listeners\ProductActionListener;
use App\Listeners\UserActionListener;
use App\Models\User;
use App\Observers\MaterialObserver;
use App\Observers\PaymentObserver;
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
        Material::observe(MaterialObserver::class);
        Payment::observe(PaymentObserver::class);
        Event::listen(UserActionEvent::class, UserActionListener::class);
        Event::listen(ProductActionEvent::class, ProductActionListener::class);
        Event::listen(MaterialActionEvent::class , MaterialActionListener::class);
        Event::listen(PaymentActionEvent::class , PaymentActionListener::class);
    }
}
