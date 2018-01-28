@php {{-- вставили пхп, так как создать переменные просто в блейде нельзя --}}
	$rate = ($p->rating)?$p->rating->rate:0; {{-- если есть рейт запишем, если нет запишем 0 --}}
	$count = ($p->rating)?$p->rating->count:1;
@endphp

<h3 class="text-center">
	<a href="{{url('product/'.$p->id)}}">{{$p->name}}</a>{{-- $p это сам продукт --}}
</h3>
		<div class="image">
			<img src="{{ asset($p->thumb) }}" class="img-responsive">
			@if($p->new == 1) {{-- если новинка --}}
				<div class="new"><img src="{{ asset('images/Nokia-215-Dual-SIM-specs-front-png.png') }}"></div>
			@endif
			@if($p->sale == 1) {{-- если скидка --}}
				<div class="sale"><img src="{{ asset('images/b4444c54c2976dc99c457907a3a37d5e.png') }}"></div>
			@endif
		</div>

<div id="raiting_star">
	<div id="raiting">
	<div id="raiting_blank"></div> <!--блок пустых звезд-->
	<div id="raiting_votes" style="width: {{$rate / $count * 17}}px"></div> <!--блок с итогами голосов -->

</div>

<div class="price text-center">{{$p->price}} $</div>	


</div>
