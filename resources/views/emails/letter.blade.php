<h1>Привет, {{ $user->name }}!</h1>
@foreach($product as $p)
<a href="http://shop/product/{{ $p->id }}">{{ $p->name }}</a> <br>
@endforeach