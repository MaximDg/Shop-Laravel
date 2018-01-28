@extends('layouts.app')

@section('content')
<h1>{{$product->name}}</h1>
<div id="raiting_star">
<div id="raiting">
<div id="raiting_blank"></div> <!--блок пустых звезд-->
<div id="raiting_hover"></div> <!--блок  звезд при наведении мышью-->
<div id="raiting_votes"></div> <!--блок с итогами голосов -->
</div>
<div id="raiting_info"><!-- <h5>Тут будет иконка загрузки и все такое</h5> --></div>
</div>
<div class="row">
	<div class="col-sm-4">
		<div class="image">
			<img src="{{ asset($product->thumb) }}" class="img-responsive">
			@if($product->new == 1) {{-- если новинка --}}
				<div class="new"><img src="{{ asset('images/Nokia-215-Dual-SIM-specs-front-png.png') }}"></div>
			@endif
			@if($product->sale == 1) {{-- если скидка --}}
				<div class="sale"><img src="{{ asset('images/b4444c54c2976dc99c457907a3a37d5e.png') }}"></div>
			@endif
		</div>
	</div>
	<div class="col-sm-8">
		<div class="price">
			
			@if($product->price_sale)

			<h4>Цена: 
			<span class="old-price"> 
				{{ $product->price }}
				$
			</span>	
			<span class="new-price">
				{{ $product->price_sale }}
				$
			</span>			
			</h4>
			@else
			<h4>Цена: 
			<span class="standart-price">
				{{ $product->price }}
				$
			</span>			
			</h4>
			@endif
		</div>
		Категория:
		<a href="{{ url('category/'.$product->category->id) }}"> {{-- если прописаны связи, можно получать любые данные из связанных таблиц. Связи прописаны в файле продукт.пхп --}}
		 {{ $product->category->name }} {{-- узнаем название сатегории из массива данных про категорию --}}
		</a>
		<br>
		Производитель:
		<a href="{{ url('category/'.$product->manufacture->id) }}"> {{-- если прописаны связи, можно получать любые данные из связанных таблиц. Связи прописаны в файле продукт.пхп --}}
		 {{ $product->manufacture->name }} {{-- узнаем название сатегории из массива данных про категорию --}}
		</a>
		<br>
		{!! Form::open() !!}
		<div class="form-group">
			{!! Form::label('qty', 'Количество') !!}
			{!! Form::number('qty', '1', ['class'=>'form-control']) !!}
			{!! Form::hidden('product_id', $product->id) !!}
		</div>
	
		<div class="text-center">
		@if($product->in_stock)
			{!! Form::submit('Добавить в корзину', ['class'=>'btn btn-primary add']) !!} {{--на класс add будем вешать клик--}}
		@else
			{!! Form::submit('Нет в наличии', ['disabled'=>'disabled']) !!}
		@endif
		</div>

		{!! Form::close() !!}

	</div> 
</div>
<div class="row">
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#description" data-toggle="tab">
					Описание
				</a>
			</li>
			<li>
				<a href="#reviews" data-toggle="tab">
					Отзывы
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="description" class="tab-pane fade in active">
				{!! $product->description !!}
			</div>
			<div id="reviews" class="tab-pane fade">
				@include('product.reviews') {{-- отзывы делаем отдельным файлом для удобства. создаем этот файл в ресурсес вьюс продукт файл reviews.blade.php --}}
			</div>
		</div>
	</div>
</div>
@endsection


@section('script'){{-- тут будем выводить скрипт на рейтинг --}}



<script type="text/javascript">
$(document).ready(function(){

count = '{{$product->rating->count or 0}}';// получаем столбец каунт
rate = '{{$product->rating->rate or 0}}';// получаем столбец rate
total_reiting = rate / count; // итоговый ретинг
id_arc = '{{$product->id}}'; // id товара 
var star_widht = total_reiting*17 ; //17 - ширина 1й звездочки в пикселах
$('#raiting_votes').width(star_widht);
$('#raiting_info h5').append(total_reiting);
he_voted = $.cookie('article'+id_arc); // проверяем есть ли кука? Пhe_voted = Одправили, так как новая версия джиквери
he_voted = null;// добавили чтоб обнулялся кук и можно было много раз голосовать
if(he_voted == null){
$('#raiting').hover(function() {
      $('#raiting_votes, #raiting_hover').toggle();
	  },
	  function() {
      $('#raiting_votes, #raiting_hover').toggle();
});
var margin_doc = $("#raiting").offset();
$("#raiting").mousemove(function(e){
var widht_votes = e.pageX - margin_doc.left;
//console.log(e.pageX , margin_doc.left, widht_votes)
if (widht_votes == 0) widht_votes =1 ;
user_votes = Math.ceil(widht_votes/17);  // вычисляется оценка для отрисовки
// обратите внимание переменная  user_votes должна задаваться без var, т.к. в этом случае она будет глобальной и мы сможем к ней обратиться из другой ф-ции (нужна будет при клике на оценке.
$('#raiting_hover').width(user_votes*17);
});
// отправка
$('#raiting').click(function(){
$('#raiting_info h5, #raiting_info img').toggle();
$.post(// $.get функция джиквери отправляет данные гетом. короткая функция, отправляющая с помощью аякса 
"/public/rating",// адрес, куда посылаем данные аяксом
{id_arc: id_arc, user_votes: user_votes}, 
function(data){// (data) - переменная, в которую возвращает функция из продукт контроллер public function rating(Request $request){...echo $r->rate / $r->count();}
	//$("#raiting_info h5").html(data);
	$('#raiting_votes').width(data*17).show();//.show() добавит отображение изменения рейтинга сразу
	$('#raiting_info h5, #raiting_info img').toggle();
	$.cookie('article'+id_arc, 123, {expires: 365}); // создаем куку. Подправили так как новая джиквери. {expires: 365} - время жизни кука (в днях)
	$('#raiting').unbind();
       $('#raiting_hover').hide();
         
        }
	   )
								   });
}
						   });
</script>
@endsection
