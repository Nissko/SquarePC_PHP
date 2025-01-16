@extends('layouts.layout')
@section('title', 'Личный кабинет')
@section('content')
    <link rel="stylesheet" href="{{asset('css/account-style.css')}}">
    <section class="c-section-info">
        <div class="c-hero">
            <div class="c-hero_image">
                <img class="o-media-wrapper" src="{{asset('img/account.jpg')}}" width="1920" height="1080">
            </div>
        </div>
        <div class="name_page-style">Личный кабинет</div>
    </section>

    <div class="account-page-main container-md">
        <div class="account-page-left_menu">
            <div class="account-page-left_menu-avatar">
                <img class="account-page-avatar_photo" src="{{ asset('storage/img/account_photo/'.$data -> photo)}}" width="120" title="Ваше фото">
                <div class="account-page-avatar_name-user">
                    {{ $data -> surname }} {{ $data -> name}}
                </div>
            </div>
            <div class="account-page-total_sum_orders">
                Общая сумма заказов: {{ $total }} руб.
            </div>
            <div class="account-page-total_count_orders">
                Всего заказов:
                {{ $count }}
            </div>
            <a class="account-page-button_show_orders-style show_orders">
                Мои заказы
            </a>
            <div class="account-page-buttons">
                <button class="account-page-style_buttons change_password">Изменить пароль</button>
                <button class="account-page-style_buttons change_photo">Изменить фото</button>
                <a class="account-page-style_buttons" href="/logout">Выйти из аккаунта</a>
            </div>
        </div>
        <div class="account-page-right_menu" data-aos="fade-left" data-aos-once="true">
            <div class="account-page-right_menu-title_blocks">
                Добро пожаловать в личный кабинет!
            </div>
            <div class="account-page-right_menu-info">
                <div class="info-text">Личный кабинет является удобным инструментом для управления Вашими заказами и контроля за своими расходами. Мы рекомендуем использовать эту возможность, чтобы получить максимальную отдачу от наших покупок и наслаждаться беззаботными покупками.</div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.change_photo').click(function (event) {
                let id = {{ $data -> id }};
                ChangePhoto(id);
            });
            $('.change_password').click(function (event) {
                let id = {{ $data -> id }};
                ChangePassword(id);
            });
            $('.show_orders').click(function (event) {
                let id = {{ $data -> id }};
                ShowOrders(id);
            });
        })

        function ShowOrders(id){
            $.ajax({
                url: '{{ route('ShowOrder')}}',
                type: "POST",
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $('.account-page-right_menu-title_blocks').html('История заказов');
                    $('.account-page-right_menu-info').html(data.options);
                }
            });
        }

        function ChangePhoto(id){
            $.ajax({
                url: '{{ route('changePhoto')}}',
                type: "POST",
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $('.account-page-right_menu-title_blocks').html('Изменение фотографии профиля');
                    $('.account-page-right_menu-info').html(data.options);
                }
            });
        }

        function ChangePassword(id){
            $.ajax({
                url: '{{ route('changePassword')}}',
                type: "POST",
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $('.account-page-right_menu-title_blocks').html('Изменение пароля профиля');
                    $('.account-page-right_menu-info').html(data.options);
                }
            });
        }
    </script>
@endsection
