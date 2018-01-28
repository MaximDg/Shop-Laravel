<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function user(){ //теперь ьчерез юзер айди можно получить всю инфу о пользователе оставвшем коммент
    	return $this->belongsTo('App\User', 'user_id');
    }
}
