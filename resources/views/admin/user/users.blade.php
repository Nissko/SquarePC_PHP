@extends('layouts.layout')
@section('title', 'Панель администратора')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.min.css') }}"/>
    <script src="{{ asset('script/bootstrap/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
    <main class="o-main">
        <section class="c-section-info">
            <div class="c-hero">
                <div class="c-hero_image">
                    <img class="o-media-wrapper" src="{{ asset('img/admin_panel.jpg') }}" width="1920" height="1080">
                </div>
            </div>
            <div class="name_page-style">Управление заказами</div>
        </section>
        <div class="admin-main-content container">
            <div class="fs-3 pb-3">
                Возможности:
            </div>
            <div class="d-flex align-items-center w-100 admin-functional-block">
                <a class="btn btn-primary admin-functional-btn" href="{{ route('admin.order.index') }}">Управление заказами</a>
                <a class="btn btn-primary admin-functional-btn" href="{{ route('admin.component.index') }}">Управление комплектующими</a>
                <a class="btn btn-primary admin-functional-btn" href="{{ route('admin.package.index') }}">Управление сборками</a>
                <a class="btn btn-primary admin-functional-btn" href="{{ route('admin.user.index') }}">Управление пользователями</a>
            </div>
            <div class="pt-5 pb-3 fs-3 heading-functional">
                {{--Действие--}}
                Пользователи
            </div>
            <div class="d-flex flex-wrap admin-action-content">
                {{--Вывод действия--}}
                @foreach($users as $user)
                    <div class="card" style="width: 22rem;">
                        <div class="card-body">
                            <h5 class="card-title">Пользователь - {{ $user -> id }}</h5>
                            @if($user->role === 'admin')
                                <h6 class="card-subtitle mb-2 text-muted">Роль: Администратор</h6>
                            @else
                                <h6 class="card-subtitle mb-2 text-muted">Роль: Пользователь</h6>
                            @endif
                            <div class="card-text mb-2">
                                <details class="details-style">
                                    <summary>Информация о пользователе</summary>
                                        <div class="fw-bold pt-1 pb-1 fs-5">
                                            {{ $user-> last_name . " " . $user->first_name . " " . $user->patronomic }}
                                        </div>
                                        <div>
                                            <div class="mb-1">Имя: {{ $user -> first_name }}</div>
                                            <div class="mb-1">Фамилия: {{ $user -> last_name }}</div>
                                            @if(isset($user->patronomic))
                                                <div class="mb-1">Отчество: {{ $user -> patronomic }}</div>
                                            @endif
                                            <div class="mb-1">Почта: {{ $user -> email }}</div>
                                            <div class="mb-1">Логин: {{ $user -> login }}</div>
                                            <div class="w-100 mb-2">Фото профиля:<img src="{{ asset('storage/img/account_photo/'. $user->photo) }}" width="100%"></div>
                                            <div>Профиль зарегистрирован: {{ $user -> created_at -> format('d.m.Y') }}</div>
                                        </div>
                                </details>
                            </div>
                            {{--Изменение профиля--}}
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userUpdate{{$user->id}}">
                                Изменить
                            </button>

                            {{--Изменение профиля модальное окно--}}
                            <div class="modal fade" id="userUpdate{{$user->id}}" tabindex="-1" aria-labelledby="userUpdate" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Изменение профиля</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.user.update', $user -> id) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                <div>
                                                    {{--Имя--}}
                                                    <label class="form-label" for="user-name">Имя</label>
                                                    <input id="user-name" type="text" class="form-control mb-2" name="first_name" value="{{ $user -> first_name }}">

                                                    {{--Фамилия--}}
                                                    <label class="form-label" for="user-surname">Фамилия</label>
                                                    <input id="user-surname" type="text" class="form-control mb-2" name="last_name" value="{{ $user -> last_name }}">

                                                    {{--Отчество--}}
                                                    <label class="form-label" for="user-patronomic">Отчество</label>
                                                    <input id="user-patronomic" type="text" class="form-control mb-2" name="patronomic" value="{{ $user -> patronomic }}">

                                                    {{--Почта--}}
                                                    <label class="form-label" for="user-email">Почта</label>
                                                    <input id="user-email" type="email" class="form-control mb-2" name="email" value="{{ $user -> email }}">

                                                    {{--Роль--}}
                                                    <label class="form-label" for="user-role">Роль</label>
                                                    <select id="user-role" class="form-select mb-2" name="role">
                                                        <option selected disabled>
                                                            @if($user->role === 'admin')
                                                                Администратор
                                                            @else
                                                                Пользователь
                                                            @endif
                                                        </option>
                                                        <option value="user">Пользователь</option>
                                                        <option value="admin">Администратор</option>
                                                    </select>

                                                    {{--Фото профиля--}}
                                                    {{--<label class="form-label" for="user-photo">Фото профиля</label>
                                                    <input id="user-photo" type="file" class="form-control" name="photo">--}}
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                                <button type="submit" class="btn btn-primary">Изменить</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </main>
@endsection
