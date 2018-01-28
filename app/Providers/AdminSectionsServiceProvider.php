<?php

namespace App\Providers;

use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $sections = [
        \App\User::class => 'App\Http\Sections\Users',// раскоментили, т.к. Users то же будет
        \App\Manufacture::class => 'App\Http\Sections\Manufactures',// добавили для Manufacture. первая часть - какую модель связываем. вторая часть - создаст файл Manufactures (тут будем писать что нам нужно в мануфактуре)
        \App\Category::class => 'App\Http\Sections\Categorie',
        \App\Product::class => 'App\Http\Sections\Products',// ВО МНОЖЕСТВЕННОМ ЧМСЛЕ! Выше - не правильно
        \App\Option::class => 'App\Http\Sections\Options',
        \App\Order::class => 'App\Http\Sections\Orders',
        \App\OrderItem::class => 'App\Http\Sections\OrderItem',
    ];

    /**
     * Register sections.
     *
     * @return void
     */
    public function boot(\SleepingOwl\Admin\Admin $admin)
    {
    	//

        parent::boot($admin);
    }
}
