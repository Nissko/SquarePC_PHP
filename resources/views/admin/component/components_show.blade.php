@extends('layouts.layout')
@section('title', 'Панель администратора')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.min.css') }}"/>
    <script src="{{ asset('script/bootstrap/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-style_packages.css') }}">
    <main class="o-main">
        <section class="c-section-info">
            <div class="c-hero">
                <div class="c-hero_image">
                    <img class="o-media-wrapper" src="{{ asset('img/admin_panel.jpg') }}" width="1920" height="1080">
                </div>
            </div>
            <div class="name_page-style">Управление комплектующими</div>
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
                Управление комплектующими: <span class="fs-3 fw-bold">{{ $models -> name }}</span>
            </div>
            <div class="d-flex flex-wrap admin-action-content">
                {{--Вывод действия--}}
                <div class="d-flex flex-column">
                    <div class="mb-3 d-flex flex-wrap gap-4">
                        <a href="{{ route('admin.cpu.show', $models -> id) }}" class="text-black">
                            <div class="card" style="width: 18rem;">
                                <div class="model-img">
                                    <img src="{{ asset('img/components/cpu.png') }}" class="card-img-top p-2" alt="Img">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-center">Процессор</h5>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.motherboard.show', $models -> id) }}" class="text-black">
                            <div class="card" style="width: 18rem;">
                                <div class="model-img">
                                    <img src="{{ asset('img/components/motherboard.png') }}" class="card-img-top p-2" alt="Img">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-center">Материнская плата</h5>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.ram.show', $models -> id) }}" class="text-black">
                            <div class="card" style="width: 18rem;">
                                <div class="model-img">
                                    <img src="{{ asset('img/components/ram-memory.png') }}" class="card-img-top p-2" alt="Img">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-center">Оперативная память</h5>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.gpu.show', $models -> id) }}" class="text-black">
                            <div class="card" style="width: 18rem;">
                                <div class="model-img">
                                    <img src="{{ asset('img/components/video-card.png') }}" class="card-img-top p-2" alt="Img">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-center">Видеокарта</h5>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.psu.show', $models -> id) }}" class="text-black">
                            <div class="card" style="width: 18rem;">
                                <div class="model-img">
                                    <img src="{{ asset('img/components/supply.png') }}" class="card-img-top p-2" alt="Img">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-center">Блок питания</h5>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.hdd.show', $models -> id) }}" class="text-black">
                            <div class="card" style="width: 18rem;">
                                <div class="model-img">
                                    <img src="{{ asset('img/components/hard-drive.png') }}" class="card-img-top p-2" alt="Img">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-center">Жесткий диск</h5>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.ssd.show', $models -> id) }}" class="text-black">
                            <div class="card" style="width: 18rem;">
                                <div class="model-img">
                                    <img src="{{ asset('img/components/ssd.png') }}" class="card-img-top p-2" alt="Img">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-center">SSD диск</h5>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.cooling.show', $models -> id) }}" class="text-black">
                            <div class="card" style="width: 18rem;">
                                <div class="model-img">
                                    <img src="{{ asset('img/components/cooling-fan.png') }}" class="card-img-top p-2" alt="Img">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-center">Охлаждение</h5>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.case.show', $models -> id) }}" class="text-black">
                            <div class="card" style="width: 18rem;">
                                <div class="model-img">
                                    <img src="{{ asset('img/components/desktop.png') }}" class="card-img-top p-2" alt="Img">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-center">Корпус</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
