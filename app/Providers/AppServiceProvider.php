<?php

namespace App\Providers;

use App\VoucherCode;
use App\Observers\VoucherCodeObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Builder::defaultStringLength(191);
      VoucherCode::observe(VoucherCodeObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
