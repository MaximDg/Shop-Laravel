<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
            return $this->belongsToMany('\App\Role', 'user_roles', 'user_id', 'role_id'); //Юзера связываем с '\App\Role'(модель, которая связана с табл Roles из БД) .('user_roles'название таллицы в которой происходит связь. 'user_id', 'role_id' - колонки которые связываются)
    }

    public function hasRole($role){// чтобы узнать есть ли у юзера роль и какая/ Админ ли? Вернет тру усли админ. фолс если нет
            $roles = $this->roles->toArray();//получим все роли пользователя. зис. этот нужный юзер, из верхней функции ролес, собираем в многомерный массив (в нем все о юзере)
            $r = array_pluck($roles, 'name');// из массива выбирает только имена и формирует их в одномерный массив
            return in_array($role, $r);// есть ли искомый элемент $r в массиве $role

    }

}
