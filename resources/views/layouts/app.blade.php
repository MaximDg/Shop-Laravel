<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick/slick.css') }}"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/my.css') }}"> 
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <p class="phone">Наш телефон: {{ $phone->value }}</p>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                       
                        {!! Form::open(['action'=>'ProductController@search', 'method'=>'GET']) !!}
                        <div class="input-group">
                            {!! Form::text('s', '', ['class'=>'form-control', 'placeholder'=>'Поиск']) !!}
                            <div class="input-group-btn">
                                {!! Form::submit('Найти', ['class'=>'btn btn-default']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}

                        @php     
                        $sum = 0;
                        if (session('cart')){
                        foreach (session('cart') as $p) 
                        {
                            $sum += $p['q'];            
                        }
                        }
                        @endphp
                        
                        <li><a href="#" data-target="#myModal" data-toggle="modal">Кoрзина Количество товара: {{ $sum }} Сумма: {{ session('totalSum') }}</a></li>

                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            @if(Auth::user()->hasRole('admin'))
                            <li><a href="{{url('/admin')}}">Администрирование сайта</a></li>
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name}} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>

                </div>
            </div>
        </nav>

 </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    @widget('ProductCategories')
                </div>
                <div class="col-sm-8">
                    @yield('content')
                </div>
            </div>
        </div>          
    </div>
   
    <!-- Modal  Скопировали с https://www.w3schools.com/bootstrap/bootstrap_modal.asp это форма для карзины -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ваша карзина</h4>
      </div>
      <div class="modal-body">
        @include('product.cart')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning clear-cart">Очистить корзину</button>
        <a href="{{ url('/checkout') }}" class="btn btn-primary">Оформить заказ</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>

      </div>
    </div>
</div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>        
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>

    <script type="text/javascript" src="{{ asset('js/jquery.cookie.js') }}"></script>
    @yield('script')   

    <script type="text/javascript" src="{{ asset('slick/slick/slick.min.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function(){

        $('.autoplay').slick({
          slidesToShow: 3,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 2500,
        });
});
  </script>
  <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
</body>
</html>
