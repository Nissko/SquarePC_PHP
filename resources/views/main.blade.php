@section('content')
    <main>
        <section class="c-section">
            <div class="c-hero-full-height">
                <div class="c-hero_video">
                    {{--<video src="video/video.m4v" preload="none" autoplay muted loop playsinline>--}}
                    <video src="{{ asset('video/video.m4v') }}" preload="none" autoplay muted loop playsinline></video>
                    <a class="scroll-down" aria-label="Scroll to content" href="#content">
                        <svg width="16" height="46" viewBox="0 0 16 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.8339 36.4667L8.92883 42.1303L8.92883 -3.09091e-07L7.2913 -3.8067e-07L7.29129 42.1064L1.36143 36.4667L0.195311 37.5899L8.11006 45.1174L16 37.5899L14.8339 36.4667Z" fill="white"></path>
                        </svg>
                    </a>
                </div>
                <div class="c-hero_container">
{{--
                    <div>Стильные корпуса, мощные комплектующие - найдите у нас все для компьютера мечты</div>
--}}
                    <div>Мы продаем персональные компьютеры для вашего успеха</div>
                    <div class="c-hero_container-btn">
                        <a class="buy-btn" href="/configurator">
                            Купить
                        </a>
                        <a class="more_info-btn" href="#content">
                            Подробнее
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section id="content" class="container">
            <div class="main-block_firs-section">
                <div class="main-block_firs-section-text" data-aos="fade-right" data-aos-once="true">
                    <span class="main-block_firs-section-heading_text">Выбирайте модель:</span><br>
                    <span class="main-block_firs-section-main_text">Удобный выбор модели на нашем сайте, не составит трудностей, чтобы выбрать то, что нужно Вам! Просто выберите модель исходя из задачи и конфигурируйте ее так, как Вам нужно!</span>
                </div>
            </div>

            <div class="main-block_second-section">
                <div class="main-block_second-section-text" data-aos="fade-left" data-aos-once="true">
                    <span class="main-block_second-section-heading_text">Выбирайте комплектацию:</span><br>
                    <span class="main-block_second-section-main_text">Покупайте компьютеры в <u>2 клика</u>, выбирая наши «Комплектации», которые предлагают для Вас лучший выбор комплектующих на наш взгляд или конфигурируйте их по своему!</span>
                </div>
            </div>
        </section>
    </main>
@endsection
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SQUARE | @yield('title', 'Главная')</title>
    <link rel="stylesheet" href="{{asset('css/css.css')}}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Шрифты -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">
    <!-- Скрипты для главной страницы -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="script/scroll-top-menu.js"></script>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/3.0.0-beta.6/aos.js"></script>
<script src="{{ asset('script/scroll_to_content-menu.js') }}"></script>
<script src="{{ asset('script/show_menu.js') }}"></script>
<script>
    AOS.init({
        easing: 'ease-out-cubic',
        duration: 500
    });
</script>
</body>
</html>
