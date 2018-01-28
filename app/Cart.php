<?php

namespace App;

use Illuminate\Support\Facades\Session;//подключение к сессии а не к БД

class Cart
{
    public static function add($p, $q){//функция на запись сессии с выбранными товарами. Будем использовать метод Session::put( 'имя сессии', 'что тыда записываем' ). Для считывание из сессии Session::get('имя сессии')

    	if(Session::get('cart.'.$p->id)) //есть ли такой элемен массива
    	{
    		$qOld = Session::get('cart.'.$p->id.'.q'); //сколько этого товара было в карзине
    		Session::put('cart.'.$p->id.'.q', $qOld + $q);// перезаписали $qOld (добавили). Для того чтобы можно было добавить еще одну единицу уже выбранного товара до этого
    	}

    	else{

    	Session::put('cart.'.$p->id.'.id', $p->id );//.$p->id., . . вместо [] (так записывается в ларавель)
		Session::put('cart.'.$p->id.'.name', $p->name );
		Session::put('cart.'.$p->id.'.thumb', $p->thumb );
		Session::put('cart.'.$p->id.'.price', $p->price );
    	Session::put('cart.'.$p->id.'.q', $q );
    	}
    	self::total();//вызов функции тотал. Через селф, потому что вызывается внутри другого метода а не на пример в контроллере. Если бы не внутри класса - Cart::total
	}

	public static function total(){// функция на общую сумму в корзине
		$sum = 0;
		foreach (session('cart') as $p) 
		{
			$sum += $p['price'] * $p['q'];//$sum сумма всех товаров
		}
		Session::put('totalSum', $sum);//$sum записали в сессию
	}
	public static function clear(){//ункция, используется в public function clearcart(Request $request) из продукт контроллера
        Session::forget('cart');
        Session::forget('totalSum');
   }
	public static function deleteProduct($id){//ункция, используется в public function del(Request $request) из продукт контроллера
        Session::forget('cart.'.$id);//удалить товар с выбранным айди
        self::total();//обновляет сумму.Функция total() прописана раннее
   }

   	public static function changeQty($id, $qty){//
        Session::put('cart.'.$id.'.q', $qty);// 
        self::total();//обновляет сумму.Функция total() прописана раннее

   }

}