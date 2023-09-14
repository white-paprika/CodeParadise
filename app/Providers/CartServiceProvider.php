<?php

namespace App\Providers;

use App\Services\CartService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Прокидывает $cartItemsCount при подгрузке layouts.app 
        // NOTE: провайдеры нужно зарегистрировать в config/app.php
        View::composer('layouts.app', function ($view) {
            if (auth()->check() && auth()->user()->role == 'user') {
                $cartItemsCount = CartService::getCart(auth()->user()->id)->cartItems()->count();
                $view->with('cartItemsCount', $cartItemsCount);
            }
        });
    }
}
