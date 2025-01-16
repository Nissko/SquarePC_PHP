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
                Управление заками
            </div>
            <div class="d-flex flex-wrap admin-action-content">
                {{--Вывод действия--}}
                @foreach($orders as $order)
                    <div class="card" style="width: 22rem;">
                        <div class="card-body">
                            <h5 class="card-title">Заказ {{ $order -> name }} #{{ $order -> id }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Статус: {{ $order -> status }}</h6>
                            @if($order -> status === 'Отменён')
                                <h6 class="card-subtitle mb-2 text-muted">Причина отмены: {{ $order -> message_status }}</h6>
                            @endif
                            <div class="card-text mb-2">
                                <details class="details-style">
                                    <summary>Состав заказа</summary>
                                    @foreach($order -> Positions as $order_item)
                                        <div class="position-name">
                                            Компьютер: {{ $order_item -> model_name}} - {{ $order_item -> package_name }}
                                        </div>
                                        <div class="position-items">
                                            <div class="position-cpu">
                                                -<span>{{ $order_item -> cpuses -> name}}</span>
                                            </div>
                                            <div class="position-motherboard">
                                                -<span>{{ $order_item -> motherboardses -> name}}</span>
                                            </div>
                                            <div class="position-ram">
                                                -<span>{{ $order_item -> rams -> name}}x{{ $order_item -> count_ram }}</span>
                                            </div>
                                            <div class="position-gpu">
                                                -<span>{{ $order_item -> gpuses -> name}}</span>
                                            </div>
                                            <div class="position-psu">
                                                -<span>{{ $order_item -> psuses -> name}}</span>
                                            </div>
                                            <div class="position-disk">
                                                -<span>{{ $order_item -> disks -> name}}</span>
                                            </div>
                                            <div class="position-ssd">
                                                -<span>{{ $order_item -> ssds -> name}}</span>
                                            </div>
                                            <div class="position-price">
                                                Стоимость компьютера: {{ $order_item -> price }} ₽
                                            </div>
                                        </div>
                                    @endforeach
                                </details>
                            </div>
                            <div class="d-flex gap-1">
                                <div class="w-100 change-status">
                                    <!-- Изменение статуса -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeStatus">
                                        Изменить статус
                                    </button>

                                    <!-- Модальное окно изменения статуса -->
                                    <div class="modal fade" id="changeStatus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Изменение статуса заказа</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.order.update', $order->id) }}" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-body">
                                                        <label for="select-status" class="form-label">Выберите новый статус заказа:</label>
                                                        <select id="select-status" class="form-select" name="status_order_change">
                                                            <option selected disabled>{{ $order -> status }}</option>
                                                            <option value="Новый">Новый</option>
                                                            <option value="Оплачен">Оплачен</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Назад</button>
                                                        <button type="submit" class="btn btn-primary">Подтвердить</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100 order-cancel">
                                    <!-- Отменить заказ -->
                                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        Отменить заказ
                                    </button>

                                    <!-- Модальное окно отмены -->
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Отмена заказа</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.order.Cancelupdate', $order->id) }}" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-body">
                                                        <label for="cancel-order" class="form-label">Укажите причину отмены заказа</label>
                                                        <input id="cancel-order" type="text" class="form-control" name="order_cancel_reason" placeholder="">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Назад</button>
                                                        <button type="submit" class="btn btn-primary">Подтвердить</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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
