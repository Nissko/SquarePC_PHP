@extends('layouts.layout')
@section('title', 'Наши проекты')
@section('content')
    <link rel="preload" as="image" href="{{ asset('img/slider/slide1.jpg') }}">
    <link rel="preload" as="image" href="{{ asset('img/slider/slide2.jpg') }}">
    <link rel="preload" as="image" href="{{ asset('img/slider/slide3.jpg') }}">
    <link rel="preload" as="image" href="{{ asset('img/slider/slide4.jpg') }}">
    <link rel="stylesheet" href="{{asset('css/project.css')}}">
    <main class="o-main">
        <section class="c-section-info">
{{--            <div class="c-hero">
                <div class="c-hero_image">
                    <img class="o-media-wrapper-project" width="3840" height="2160">
                </div>

            </div>
            <div class="name_page-style">НАШИ ПРОЕКТЫ</div>--}}
        </section>
        <section class="slider-content">
            <div class="single-item">
                <div class="slider_style">
                    <img class="slider_style__img" src="{{ asset('img/slider/slide1.jpg') }}">
                </div>
                <div class="slider_style">
                    <img class="slider_style__img"  src="{{ asset('img/slider/slide2.jpg') }}">
                </div>
                <div class="slider_style">
                    <img class="slider_style__img" src="{{ asset('img/slider/slide3.jpg') }}">
                </div>
                <div class="slider_style">
                    <img class="slider_style__img" src="{{ asset('img/slider/slide4.jpg') }}">
                </div>
            </div>
        </section>

    </main>
    <script>

    </script>
@endsection
