<ul class="nav nav-pills nav-stacked">
	@foreach($categories as $category)
	<li {!! Request::is('category/'.$category->id)?'class="active"':""!!}><a href="{{url('category/'.$category->id)}}">{{$category->name}}</a></li>
	@endforeach
</ul>