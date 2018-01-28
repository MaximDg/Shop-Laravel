@extends('layouts.app')

@section('content')

<h2 class="carusel">НОВИНКИ   <img src="{{ asset('images/Nokia-215-Dual-SIM-specs-front-png.png') }}" style="width: 70px;"></h2>
  <div class="autoplay"> 
  	@foreach($new as $news)   
      <div><img src="{{ asset($news->thumb) }}"></div>
    @endforeach  
  </div>   
<br><br>

    <div class="row">
        <div class="col-md-12">
        	<ul class="nav nav-pills nav-stacked">
				@foreach($categories as $category)
				<li><a href="{{url('category/'.$category->id)}}" style="float: left; width: 50%; color: #777; font-size: 24px; font-weight: bold;">{{$category->name}}</a><img src="{{ asset($category->thumb) }}" style="width: 85px;"></li>
				@endforeach
			</ul>
        </div>
    </div>

<br><br>
<h2 class="carusel">ТОВАР СО СКИДКОЙ   <img src="{{ asset('images/b4444c54c2976dc99c457907a3a37d5e.png') }}" style="width: 70px;"></h2>
  <div class="autoplay"> 
  	@foreach($sale as $sales)   
      <div><img src="{{ asset($sales->thumb) }}"></div>
    @endforeach  
  </div>   

@endsection

