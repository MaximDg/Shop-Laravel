@if (Auth::guest()) {{-- если гость. то <p></p> --}}
<p>Вы должны быть авторизованны<a href="{{ route('login') }}">Login</a></p>
@else

{!! Form::open(['action'=>'ProductController@addReview']) !!} {{-- ProductController контроллер addReview метод --}}
<div class="form-group">
	{!! Form::label('review', 'Оставьте Ваш отзыв') !!}
	{!! Form::textarea('review', '', ['class'=>'form-control']) !!}
</div>
{!! Form::hidden('product_id', $product->id) !!} {{-- hidden закрытое текстовое поле, для отправки айди товата в БД --}}
{!! Form::hidden('user_id', Auth::user()->id) !!} {{-- Auth::user() возвращает все о зарегистрированном пользователе из таблицы --}}
{!! Form::submit('Добавить отзыв', ['class'=>'btn-primary']) !!}
{!! Form::close() !!}
<br>
<br>

@endif

@foreach($product->reviews as $rev) {{-- после того как в продукт пхп в переменную продукт добавили все отзывы, тепоерь их можно из нее достать --}}
<div class="panel panel-primary">
	<div class="panel-heading ">{{ $rev->user->name }}</div>
	<div class="panel-body">{{ $rev->comment }}</div>
</div>
@endforeach