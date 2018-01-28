@if(session('cart')) {{-- есть сессия есть - выводим табличку, если нет - <p>Ваша карзина пустая</p> --}}
<table class="table">
	<thead>
		<tr>
			<th>Изображение</th>
			<th>Название</th>
			<th>Количество</th>
			<th>Цена</th>
			<th>Сумма</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	@foreach(session('cart') as $product)
		<tr>
			<td><img src="{{ asset($product['thumb']) }}" style="width: 150px"></td>{{--  берем из сессии а не из бд --}}
			<td>{{ $product['name'] }}</td>			
			<td><input type="number" value="{{ $product['q'] }}" class="qty" data-id="{{ $product['id'] }}"></td> {{-- 'q' - количество, $product['id'] aйди нужного товара --}}
			<td>{{ $product['price'] }}</td>
			<td>{{ $product['price']*$product['q'] }}</td>
			<td><a href="#" class="del" data-id="{{ $product['id'] }}">Удалить товар</a> </td> {{-- data-id="{{ $product['id'] }}"-придуманный атрибут, чтобы узнать айди --}}

		</tr>
	@endforeach

<tr>
	<td colspan="4" class="text-right">Сумма: </td>
	<td colspan="2">{{ session('totalSum') }}</td>
</tr>

	</tbody>
</table>

@else
<p>Ваша кoрзина пустая</p>
@endif