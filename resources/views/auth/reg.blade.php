@extends('layouts.layout')
@section('title', 'Регистрация')
@section('content')
    <link rel="stylesheet" href="{{asset('css/auth-reg_style.css')}}">
    <section class="c-section-info">
        <div class="c-hero">
            <div class="c-hero_image">
                <img class="o-media-wrapper" src="{{asset('img/Conf.jpg')}}" width="1920" height="1080">
            </div>
        </div>
        <div class="name_page-style">Регистрация</div>
    </section>

    <div class="content-column-reg">
        <form class="form_styles_rel-log" action="{{ route('store') }}" method="post">
            @csrf
            <span class="name-site_slogan-logo">
                SQUARE PC
            </span>
            <div class="form_warning-text">
                Регистрация аккаунта
            </div>
            <div class="form_group">
                <label for="firs_name">
                    <div class="form-label-text">Имя</div>
                    <input class="form-control" id="firs_name" type="text" name="first_name" placeholder="Иван">
                </label>
            </div>
            <div class="form_group">
                <label for="last_name">
                    <div class="form-label-text">Фамилия</div>
                    <input class="form-control" id="last_name" type="text" name="last_name" placeholder="Иванов">
                </label>
            </div>
            <div class="form_group">
                <label for="patronomic">
                    <div class="form-label-text">Отчество(если есть)</div>
                    <input class="form-control" id="patronomic" type="text" name="patronomic" placeholder="Иванович">
                </label>
            </div>
            <div class="form_group">
                <label for="email">
                    <div class="form-label-text">Почта</div>
                    <input class="form-control" id="email" type="text" name="email" placeholder="ivan.ivanov@mail.ru">
                </label>
            </div>
            <div class="form_group">
                <label for="login">
                    <div class="form-label-text">Логин</div>
                    <input class="form-control" id="login" type="text" name="login" placeholder="ivanov123">
                </label>
            </div>
            <div class="form_group">
                <label for="password">
                    <div class="form-label-text">Пароль</div>
                    <input class="form-control" id="password" type="password" name="password" placeholder="I1v2a3n4">
                </label>
            </div>
            @if(session()->has('success'))
                <div class="content_row-reg">{{ session()->get('success') }}</div>
            @endif
            {{--<div class="form_group">
                <input type="password" name="password_confirm" placeholder="Повторите пароль">
            </div>--}}
            <div class="form_group-btn">
                <button class="form_btn" type="submit" value="Войти">
                    Зарегистрироваться
                </button>
            </div>
        </form>
    </div>
@endsection
