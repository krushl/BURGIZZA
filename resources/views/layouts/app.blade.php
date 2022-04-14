<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @yield('meta')
    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!--Styles -->
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @stack('css')
</head>
<body class="font-sans">
<header>
    <a href="{{route('home')}}" class="logo">BURGIZZA</a>
    <div class="openMenu"><i class="fa fa-bars"></i></div>
    <ul class="mainMenu">
        <li><a href="{{route('menu')}}">Меню</a></li>
        <li><a href="{{route('article')}}">Новости</a></li>
        <li><a href="{{route('delivery')}}">Доставка</a></li>
        @auth
            <li><a href="{{route('basket')}}">Корзина</a></li>
            <li><a href="{{route('profile')}}">
                    {{Auth::user()->login}}
                </a></li>
            <li> <a href="{{route('logout')}}">Выйти</a></li>
        @endauth
        @guest
            <li><a href="{{route('showLoginForm')}}">Войти</a>/<a href="{{route('showRegisterForm')}}">Зарегистриоваться</a></li>
        @endguest
        <div class="closeMenu"><i class="fa fa-times"></i></div>
    </ul>
</header>

    @yield('content')

<script defer src="{{asset('asset/js/app.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('asset/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
<script>
    window.addEventListener("scroll", function () {
        let header = document.querySelector('header');
        header.classList.toggle('sticky', window.scrollY > 0);
    })
</script>
@stack('script')
</body>
</html>
