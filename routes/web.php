<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {// комментим (отключаем)
    return view('welcome');
});*/ 

Auth::routes();

Route::get('', 'HomeController@index')->name('home');//удаляем '/home' чтоб заходило на гл стр. теперь после входа на сайт автоматом кидает на http://shop/public/home
Route::get('category/{id}', 'ProductController@category');//дописали
Route::get('product/{id}', 'ProductController@show');//дописали
Route::post('/review', 'ProductController@addReview');//дописали
Route::post('rating', 'ProductController@rating');
Route::get('/search', 'ProductController@search');
Route::post('add-to-cart', 'ProductController@addToCart');
Route::post('/clearcart', 'ProductController@clearcart');
Route::post('/del', 'ProductController@del');
Route::post('/changeQty', 'ProductController@changeQty');
Route::get('/checkout', 'OrderController@checkout');
Route::get('/buy', 'OrderController@buy');