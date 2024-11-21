<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Tool;
use App\Models\User;
use App\Models\Package;
use App\Models\Payment;
use App\Services\CartService;
use App\Models\TicketResponse;
use App\Services\EmailService;
use App\Observers\CartObserver;
use App\Observers\ToolObserver;
use App\Observers\UserObserver;
use App\Models\PlanSubscription;
use App\Observers\PackageObserver;
use App\Observers\PaymentObserver;
use Illuminate\Support\ServiceProvider;
use App\Observers\TicketResponseObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cartService', function ($app) {
            return new CartService();
        });

        $this->app->singleton('emailService', function ($app) {
            return new EmailService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Tool::observe(ToolObserver::class);
        Package::observe(PackageObserver::class);
        Cart::observe(CartObserver::class);
        User::observe(UserObserver::class);
        Payment::observe(PaymentObserver::class);
        TicketResponse::observe(TicketResponseObserver::class);
    }
}
