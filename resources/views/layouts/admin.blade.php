<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
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

        @auth   <li><a href="{{route('admin.index')}}">
                Админ панель
            </a></li>
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
