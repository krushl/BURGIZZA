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
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
</head>
<body class="font-sans antialiased">
<header>
    <a href="#" class="logo">BURGIZZA</a>
    <ul>
        <li><a href="#">Меню</a></li>
        <li><a href="#">Новости</a></li>
        <li><a href="#">Доставка</a></li>
        <li><a href="#">Корзина</a></li>
        <li><a href="#">Войти/Зарегистриоваться</a></li>
    </ul>
</header>

    <div class="container-fluid h-100vh w-100 ">
    @yield('content')
    </div>


<script src="{{ asset('asset/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
<script>
    window.addEventListener("scroll", function () {
        let header = document.querySelector('header');
        header.classList.toggle('sticky', window.scrollY > 0);
    })
</script>
</body>
</html>
