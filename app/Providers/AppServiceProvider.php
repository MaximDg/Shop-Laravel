<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App\Option;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()// все что в boot(), будет работать на всех стр
    {
        //для ДЗ
        $phone = Option::where('name', 'phone')->first();
        View::share('phone', $phone);


        //колво товаров в корзине для отображения около ссылки на корзину

        //View::share('totalCount', $sum);
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
