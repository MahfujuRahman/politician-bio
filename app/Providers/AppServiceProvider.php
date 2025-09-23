<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Modules\Management\WarehouseManagement\WarehouseProductOut\Models\WareHouseProductOutProductModel as WarehouseProductOut;
use App\Modules\Management\WarehouseManagement\WarehouseProductOut\Observer\WarehouseProductOutObserver;
use Inertia\Inertia;


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
        Paginator::useBootstrap();
        // WarehouseProductOut::observe(WarehouseProductOutObserver::class);

        Inertia::share([
            'flash' => function () {
                return [
                    'success' => session('success'),
                    'error' => session('error'),
                ];
            },
        ]);
    }
}
