<h1>Новый заказ</h1>

<table class="table">
	<thead>
		<tr>
			<th style="color: red">Изображение</th>
			<th>Название</th>
			<th>Количество</th>
			<th>Цена</th>
			<th>Сумма</th>
		</tr>
	</thead>
	<tbody>
	@foreach(session('cart') as $product)
		<tr>
			<td><img src="{{ asset($product['thumb']) }}" style="width: 150px"></td>{{--  берем из сессии а не из бд --}}
			<td>{{ $product['name'] }}</td>			
			<td>{{ $product['q'] }}</td> {{-- 'q' - количество, $product['id'] aйди нужного товара --}}
			<td>{{ $product['price'] }}</td>
			<td>{{ $product['price']*$product['q'] }}</td>
		</tr>
	@endforeach

<tr>
	<td colspan="4" class="text-right">Сумма: </td>
	<td colspan="2">{{ session('totalSum') }}</td>
</tr>

	</tbody>
</table>
