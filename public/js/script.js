$('.add').click(function(e){
	e.preventDefault();// отменили стандартное действие отправка формы
	var formData = $(this).parents('form').serialize();//автоматически все элементы формы (инпут, хиден) и преобразовала в обьект, у которого свойстива это названия  элементьов формы
	$.post(// сокращенная форма аякса
		'/public/add-to-cart',
		formData,
		function(data){
			showCart(data);
		}
	);
})


function showCart(data){
	$('#myModal .modal-body').html(data);// у всплывающего окна айди myModal (так скопировали изначально) ункция .html(data) заменяет содержимое тега на return $request->product_id (айди продукта)
	$('#myModal').modal();// modal() ф-я открывает форму при нудительно

}

$('.clear-cart').click(function(e){//функция для очистки корзины
	e.preventDefault();// отменили стандартное действие отправка формы
	$.post(// сокращенная форма аякса
		'/public/clearcart',
		
		function(data){
			showCart(data);
		}
	);
})



$('.modal-body').on('click', '.del', function(e){//('.modal-body') обращаемся к классу который уже существует на стр. 
	e.preventDefault();
	var id = $(this).attr('data-id');// считываем айди через придуманный атрибут 'data-id'
	$.post(// сокращенная форма аякса
		'/public/del',//куда отправляем
		{'id_product': id},//передаваемый обьект.'id_product'-имя обьекта. 
		function(data){
			showCart(data);// обновление вида корзины
		});
	}
);



$('.modal-body').on('change', '.qty', function(e){//('.modal-body') обращаемся к классу который уже существует на стр. 'change' отрабатывается при изменении 
	e.preventDefault();
	var id = $(this).attr('data-id');// считываем айди через придуманный атрибут 'data-id'
	var q = $(this).val();//считываем количество из текстового поля
	q = (q<0)?0:q;//убираем отрицательные числа количества товара(если меньше или равно 0 - записываем 1)
	$(this).attr('disabled', 'disabled');//делает недоступным окно изменения количества, пока не отправился запрос, т.е. нельза быстро клацать изменение колва
	$.post(// сокращенная форма аякса
		'/public/changeQty',//куда отправляем
		{'id_product': id, 'qty': q},//передаваемый обьект.'id_product'-имя обьекта.  Передали айди и количество товара
		function(data){
			showCart(data);// обновление вида корзины
		});
	}
);