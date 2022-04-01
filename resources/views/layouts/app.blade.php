<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!--Styles -->
    @stack('css')
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}">
</head>
<body class="font-sans antialiased">
<header>
    <a href="{{route('home')}}" class="logo">BURGIZZA</a>
    <ul>
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
    </ul>
</header>

    @yield('content')

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
