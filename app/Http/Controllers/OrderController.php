<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderItem;
use Auth;
use Mail;
use App\Cart;

class OrderController extends Controller
{
    public function checkout()
    {
    	return view('order.checkout');
    }

    public function buy()
    {
    	$order = new Order;
    	$order->user_id = Auth::user()->id;
    	$order->total_sum = session('totalSum');
    	$order->save();

    	foreach (session('cart') as $product)
    	{
    		$item = new OrderItem;
    		$item->product_id = $product['id'];
    		$item->price = $product['price'];
    		$item->quantity = $product['q'];
    		$item->order_id = $order->id;
    		$item->save();

    	}

    	Mail::send('emails.adminOrder', [], function($m){
    		$m->to('maximderiglazov@gmail.com')->subject('Новый заказ!');
    		$m->from('maximderiglazov@gmail.com');
    	});

    	Mail::send('emails.adminOrder', [], function($m){
    		$m->to(Auth::user()->email)->subject('Ваш заказ!');
    		$m->from('maximderiglazov@gmail.com');
    	});

    	Cart::clear();
    	return back()->with('message', 'Спаибо! Ваш заказ принят.');
    } 
}
