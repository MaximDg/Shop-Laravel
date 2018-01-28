@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<h2>Ваш заказ:</h2>

		@if(session('message')) {{-- иф для вывода сообщения об удачной покупке после отправки заказа --}}
			<div class="alert alert-success">
				{{ session('message') }}
			</div>
		@endif

		@include('product.cart')
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		@if(Auth::guest())
		<p>У Вас есть аккаунт? <a href="{{ route('login') }}">Регистрация</a></p>

		@else
		<a href="{{ url('/buy') }}" class="btn btn-primary">Купить</a>
		@endif
	</div>
</div>

@endsection