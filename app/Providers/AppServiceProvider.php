<?php

namespace App\Providers;

use App\Models\DealerEarning;
use App\Models\DealerPayout;
use App\Models\DealerProduct;
use App\Models\DealerProfile;
use App\Models\LandingPage;
use App\Models\Order;
use App\Models\Product;
use App\Policies\DealerEarningPolicy;
use App\Policies\DealerPayoutPolicy;
use App\Policies\DealerProductPolicy;
use App\Policies\DealerProfilePolicy;
use App\Policies\LandingPagePolicy;
use App\Policies\OrderPolicy;
use App\Policies\ProductPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        Gate::policy(DealerEarning::class, DealerEarningPolicy::class);
        Gate::policy(DealerPayout::class, DealerPayoutPolicy::class);
        Gate::policy(DealerProduct::class, DealerProductPolicy::class);
        Gate::policy(DealerProfile::class, DealerProfilePolicy::class);
        Gate::policy(LandingPage::class, LandingPagePolicy::class);
        Gate::policy(Order::class, OrderPolicy::class);
        Gate::policy(Product::class, ProductPolicy::class);
    }
}
