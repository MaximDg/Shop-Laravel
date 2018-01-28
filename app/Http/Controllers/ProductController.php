<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;// подключили нужные модели
use App\Product;// подключили нужные модели
use App\Review;// подключили нужные модели
use App\Cart;// подключили нужные модели

class ProductController extends Controller
{
    public function category($id){//добавляем 
    	$category = Category::find($id);
    	$products = Product::where('category_id', $id)->get();
    	return view('product.category', compact('category', 'products'));//'product.category' - путь
    }

    public function show($id){//добавляем 
    	$product = Product::find($id);
    	return view('product.show', compact('product'));//'product.category' - путь
    }

    public function addReview(Request $request){//добавляем метод для создания отзывов. Используется в reviews.blade.php/ То что передаем в форме будет в переменной $request

    	$r = new Review;// то что нужно для заполнения таблицы reviews
    	$r->user_id = $request->user_id;
    	$r->product_id = $request->product_id;
    	$r->comment = $request->review;
    	$r->save();//сохраняем 

    	return back();//вернет на предыдущую страницу

    }

    public function rating(Request $request){//метод для рейтинга

        $r = \App\Rating::where('product_id', $request->id_arc)->first(); // \App\Rating то же самое что подключение через use App\...
        // выбираем из таблицы берем product_id с нужным id_arc (переменная из большого скрипта на рейтинг ()). first() - выбирает только первый элемент (можно так, потому что продукт айди один единственны, иначе нужен ->get())
        if(!$r){
            $r = new \App\Rating;// если ничего нет, создаем новый пустой обьект, если есть записываем в переменную данные
        }
        $r->product_id = $request->id_arc;// перезаписываем (product_id  - из таблицы)
        $r->count++;
        $r->rate = $r->rate + $request->user_votes;//user_votes переменная из большого скрипта на рейтинг (все эти переменные передаются в реквесте при отправке)
        $r->save();
        echo $r->rate / $r->count;//вывод результата в скритп в переменную (дата)
    }

    public function search(Request $request){// метод для поиска
        $search = '%'.$request->s.'%';//'%' любое количество любых символов (из майскюль)
        //select * from products were LIKE '%...%'; так было бы в майскл
        $products = Product::where('name', 'like', $search)->orWhere('description', 'like', $search)->get();//на продукты. ищет и по полю name и по полю description(комментарии)(поля из БД)
        $categories = Category::where('name', 'like', $search)->get();//на категории
        return view('product.search', compact('products', 'categories'));
    }

    public function addToCart(Request $request){// метод на добавление в карзину/ $request содержит айди и колво покупаемого товара
        $product = Product::find($request->product_id);//все данные о товаре который покупается
        Cart::add($product, $request->qty);//функция add записывает в сессию купленный товар, ее пропишем позже
        return view('product.cart');//product.cart - папка
    }

    public function clearcart(Request $request)//функция на очистку корзины
    {
        Cart::clear();// функция прописана в моделе карт.пхп
        return view('product.cart');
    }

    public function del(Request $request)//функция на удаление товара
    {
        Cart::deleteProduct($request->id_product);// функция прописана в моделе /карт.пхп.   
        return view('product.cart');
    }

    public function changeQty(Request $request)//функция на удаление товара
    {
        Cart::changeQty($request->id_product, $request->qty);// функция прописана в моделе /карт.пхп.   
        return view('product.cart');
    }


}
