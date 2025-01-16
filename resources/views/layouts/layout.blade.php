<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('img/logoGif.gif') }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SQUARE | @yield('title', 'Главная')</title>
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.min.css') }}"/>--}}
    <link rel="stylesheet" href="{{asset('css/css.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css') }}"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="{{ asset('script/jquery-3.6.3.js') }}"></script>
{{--    <script src="{{ asset('script/bootstrap/bootstrap.min.js') }}"></script>--}}
    <!-- Шрифты -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">
</head>
<body>
<nav class="navigation">
    <div class="menu_btn_top">
        <a href="/projects" class="project_btn">Наши проекты</a>
        <a href="/configurator" class="configurate_btn">Конфигуратор</a>
        <div class="logo-btn">
            <a class="legend-slogan" href="/"><text class="legend-slogan-text">SQUARE</text></a>
        </div>
        <a href="/info" class="aboutUs_btn">О нас</a>
        <div>
            <a class="shoppingCart_btn">
                Личный кабинет
            </a>
            <div class="sub_menu hide">
                @if($data -> role == 'guest')
                    <a class="slide-btn_1" href="/login">Вход</a>
                    <a class="slide-btn" href="/create">Регистрация</a>
                @endif
                @if($data -> role == 'user' or $data -> role == 'admin')
                    <a class="slide-btn_1" href="{{ route('account') }}">{{ $data -> surname }} {{ $data -> name }}</a>
                    <a class="slide-btn_2" href="{{ route('cart') }}">Корзина</a>
                    <a class="slide-btn" href="/logout">Выход</a>
                @endif
            </div>
        </div>
    </div>
</nav>
<div class="content">
    @yield('content')
</div>
<footer class="footer-style">
    <nav class="container-md">
        <p>&copy;2022 - <?php echo date('Y'); ?>, Магнитогорск. Все права защищены.</p>
        <p>"SQUARE PC" - является товарным знаком ООО "SQUARE", зарегистрированным в России и других странах.</p>
    </nav>
</footer>

<!-- Скрипты для главной страницы -->
<script src="{{ asset('script/slick.min.js')}}"></script>
<script src="{{ asset('script/scroll-top-menu.js') }}"></script>
<script src="{{ asset('script/show_menu.js') }}"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    $(document).ready(function(){
        AOS.init({
            easing: 'ease-out-cubic',
            duration: 500
        });
    });
    $('.single-item').slick({
        rows: 1,
        dots: true,
        arrows: true,
        infinite: true,
        speed: 2000,
        autoplay: true,
        autoplaySpeed: 2000,
    });
</script>

</body>
</html>
