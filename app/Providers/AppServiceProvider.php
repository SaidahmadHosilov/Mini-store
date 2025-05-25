<?php

namespace App\Providers;

use App\Models\Basket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {
            $basketCount = 0;
            if (Auth::check()) {
                $basketCount = Basket::where('user_id', Auth::id())
                    ->where('status', 'draft')
                    ->sum('quantity');
            }
            $view->with('basketCount', $basketCount);
        });
    }
}
