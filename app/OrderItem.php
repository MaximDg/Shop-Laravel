<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';//указали связь с табл явно

    public function product()//
    {
    	return $this->belongsTo('App\Product', 'product_id');// связываем модели
    }
}
