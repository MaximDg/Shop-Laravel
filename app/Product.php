<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    	public function category(){//добавили связи, модели продукт с моделью кетигори. и указываем в какой колонке устанавливается эта связь
    	return $this->belongsTo('App\Category', 'category_id');
    	}
        public function manufacture(){//добавили связи, то как мы назвали функцию из продуктс.пхп
    	return $this->belongsTo('App\Manufacture', 'manufacture_id');
    	}

		public function setPriceAttribute($value){ //функция на запись цены. Перпед записью в БД. все такого вида функции будут вызываться (название функции на запись должно быть СТРОГО таким setНазваниеКолонкиAttribute) 
				$this->attributes['price'] = $value?$value:'0';//value - это то что мы написали новое. attributes - встроенный массив атрибутов, выбираем нужный. Если велью пустое - запишем 0. price - название колонки в таблице БД
		}

		public function setInStockAttribute($value){ //функция на запись цены. Перпед записью в БД. все такого вида функции будут вызываться (название функции на запись должно быть СТРОГО таким setНазваниеКолонкиAttribute) 
				$this->attributes['in_stock'] = $value?'1':'0';//value - это то что мы написали новое. attributes - встроенный массив атрибутов, выбираем нужный. Если велью пустое - запишем 0. in_stock - название колонки в таблице БД

		}
		public function setNewAttribute($value){ //функция на запись цены. Перпед записью в БД. все такого вида функции будут вызываться (название функции на запись должно быть СТРОГО таким setНазваниеКолонкиAttribute) 
				$this->attributes['new'] = $value?'1':'0';//value - это то что мы написали новое. attributes - встроенный массив атрибутов, выбираем нужный. Если велью пустое - запишем 0. new - название колонки в таблице БД

		}
		public function setSaleAttribute($value){ //функция на запись цены. Перпед записью в БД. все такого вида функции будут вызываться (название функции на запись должно быть СТРОГО таким setНазваниеКолонкиAttribute) 
				$this->attributes['sale'] = $value?'1':'0';//value - это то что мы написали новое. attributes - встроенный массив атрибутов, выбираем нужный. Если велью пустое - запишем 0. sale - название колонки в таблице БД

		}

		public function reviews(){
			return $this->hasMany('App\Review', 'product_id');// делаем доступными все отзывы по данному товару
		}

		public function rating(){
			return $this->hasOne('App\Rating', 'product_id');//Связи продукт связывается с рейтингом по продукт айди
		}


}
