<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 50);
            $table->decimal('price', 10, 2);//decimal дробные числа (до и после запятой)
            $table->decimal('price_sale', 10, 2)->nullable();// цена по распродаже
            $table->integer('category_id')->unsigned();
            $table->integer('manufacture_id')->unsigned();
            $table->enum('in_stock', ['0', '1']);// или 0 или 1/ есть ли в наличии
            $table->enum('new', ['0', '1']);// новинка или нет
            $table->enum('sale', ['0', '1']);// скидка или нет (распродажа)
            $table->string('thumb', 100)->nullable();//картинка
            $table->longText('description')->nullable();//('description')
            $table->foreign('category_id')->references('id')->on('categories');// связываем колонку кетигори_айди с колонкой айди таблицы 'categories' (если есть .._id надо связывать). Для того чтобы нельзя было записать не существующее айди
            $table->foreign('manufacture_id')->references('id')->on('manufactures');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
