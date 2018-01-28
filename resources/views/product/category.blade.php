@extends('layouts.app')

@section('content')
<h1 class="text-center">{{$category->name}}</h1>
<div class="row">
	@foreach($products as $p)
		<div class="col-sm-4">
			@include('product.product')
		</div>
		@if($loop->iteration %3==0) {{-- $loop -встроенные обьект, доступен в ифе. у него узнаем ->iteration(одно из свойств $loop) (количество итераций. и если оно кратно 3 то создаем див отменяющий обтекание) --}}
			<div class="clearfix"></div>
		@endif
	@endforeach
</div>
@endsection
