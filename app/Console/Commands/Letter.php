<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Letter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'letter';//сюда пишем название команды, чтоб потом можно команду можно было запускать из консоли

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       // \Log::info('Пробное письмо');//в файл Лог выводим текст 'Пробное письмо'. Файл находится в сторедж логс файл ларавель.info выводит этот текст в этом файле. \ - аналог use Log (подключение)

        $users = \App\User::all(); // олучили всех пользователей (без подключения через Uss)
        $product = \App\Product::where('created_at', '>', \Carbon\Carbon::now()->subWeek())->get();//Carbon - встроенный обьект для работы с датами (со временем). т.е. колонка created_at из заблицы Product меньше заданной даты (т.е. новые товары)

        if($product){// если новый продукт есть, перебираем всех поьзователей и отправляем им письмо
            foreach ($users as $user) {
                \Mail::send('emails.letter', compact('user', 'product'), function($m) use($user){// use($user) открывает доступ к переменной $user через дополнительный параметр в функцию, так как в пхп изначально переменные локальные, доступа к функции не будет
                 
                    $m->from('maximderiglazov@gmail.com', 'Я');
                    $m->to($user->email)->subject('Новые товары на сайте!');
                });
            }
        }
    }
}
