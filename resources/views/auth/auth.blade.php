@extends('layouts.layout')
@section('title', 'Авторизация')
@section('content')
    <link rel="stylesheet" href="{{asset('css/auth-reg_style.css')}}">
    <section class="c-section-info">
        <div class="c-hero">
            <div class="c-hero_image">
                <img class="o-media-wrapper" src="{{asset('img/Conf.jpg')}}" width="1920" height="1080">
            </div>
        </div>
        <div class="name_page-style">Авторизация</div>
    </section>

    <div class="content-column container">
        <form class="form_styles_rel-log" action="{{ route('signup') }}" method="post">
            @csrf
            <span class="name-site_slogan-logo">
                SQUARE PC
            </span>
            <div class="form_warning-text">
                Авторизация
            </div>
            <div class="form_group">
                <label for="email">
                    <div class="form-label-text">Почта</div>
                    <input class="form-control" id="email" type="text" name="email" placeholder="ivan.ivanov@mail.ru">
                </label>
            </div>
            <div class="form_group">
                <label for="password">
                    <div class="form-label-text">Пароль</div>
                    <input class="form-control" id="password" type="password" name="password" placeholder="I1v2a3n4">
                </label>
            </div>
            @if(session()->has('success'))
                <div class="content_row">{{ session()->get('success') }}</div>
            @endif
            <div class="form_group-btn">
                <button class="form_btn" type="submit" value="Войти">
                    Войти
                </button>
            </div>
        </form>
    </div>
@endsection
