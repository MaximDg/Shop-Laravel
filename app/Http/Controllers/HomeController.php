<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;// подключили нужные модели
use App\Product;// подключили нужные модели

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');// все стр. которые открываются через конструктор, проходят через 'auth'. Зайти могут только зареганые пользователи. Эту строку комментим что бы отключить
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $new = Product::where('new', '1')->get();// для каруселей
        $sale = Product::where('sale', '1')->get();// для каруселей
        $categories = Category::all();// для отображения категорий и их картинок 

        return view('home', compact('new', 'sale', 'categories'));
    }


}