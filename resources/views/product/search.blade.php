@extends('layouts.app')

@section('content')

@if(count($products)>0) <!-- если существует $products -->
<h2>Товары: </h2>
@foreach($products as $p)
<div>
	{{$p->name}}, {{$p->price}} <br>
</div>
@endforeach
@endif

@if(count($categories)>0) <!-- если существует $categories-->
<h2>Категории: </h2>
@foreach($categories as $p)
<div>
	{{$p->name}} <br> 
</div>
@endforeach
@endif


@endsection