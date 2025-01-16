@extends('layouts.layout')
@section('title', 'Конфигуратор')
@section('content')
    <link rel="stylesheet" href="{{asset('css/configuration-style.css')}}">
    <main class="o-main">
        <section class="c-section-info">
            <div class="c-hero">
                <div class="c-hero_image">
                    <img class="o-media-wrapper" src="{{ asset('img/Conf.jpg') }}" width="1920" height="1080">
                    {{--<video class="o-media-wrapper" src="video/about.mp4" preload="none" autoplay muted loop playsinline></video>--}}
                </div>
            </div>
            <div class="name_page-style">Выбор модели</div>
        </section>
        <div class="content-legend container">
            <div>
                Конфигуратор системного блока SQUARE-PC предоставляет возможность подобрать оптимальную комплектацию ПК
                <div>и произвести проверку совместимости комплектующих.</div>
            </div>
        </div>
        <div class="conf-flex-block container">
            @foreach ($configuration as $conf)
                <a class="link-to-configurator" href="{{ route('computers_assemblies', $conf) }}">
                    <div class="conf-block js-script-{{ $conf -> id }}" data-aos="zoom-out" data-aos-delay="50">
                        <div class="conf-img-block">
{{--                            <img class="conf-img js-script-img-{{ $conf -> id }}" src="{{ asset('img/'. $conf -> img).'.png' }}" width="1920px" height="1080px">--}}
                            <img class="conf-img js-script-img-{{ $conf -> id }}" src="{{ asset('storage/img/package_photo/'. $conf -> img)}}" alt="{{ $conf -> name }}" width="100%" height="100%">
                        </div>
                        <div class="conf_name-conf">
                            {{ $conf -> name }}
                        </div>
                        <div class="conf_desc-conf">
                            {{ $conf -> description }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </main>
    <script>
        for (let i = 0; i < 99; i++){
            $('.js-script-'+i).mouseenter(function() {
                $(this).css("box-shadow", "0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.1)");
                $('.js-script-img-'+i).css("transform", "scale(1.1)");
            }).mouseleave(function(){
                $(this).css("box-shadow", "0px 0px 0px");
                $('.js-script-img-'+i).css("transform", "scale(1)");
            });
        }
    </script>
@endsection
