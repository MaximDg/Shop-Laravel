<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->user()->hasRole('admin'))//есть ли у юзера раль админ (функцию hasRole прописалит раннее)
        {
            return redirect('/');//если нет перенапрявляем
        }
        return $next($request);
    }
}
