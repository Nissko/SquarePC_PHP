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
                Управление комплектующими: <span class="fs-3 fw-bold">{{ $models -> name }} - Блоки питания</span>
            </div>
            <div class="d-flex flex-wrap admin-action-content">
                {{--Блоки питания--}}
                <container>
                    <div class="fs-3 pb-2">Блоки питания</div>
                    {{--Добавление блока питания--}}
                    <container>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#PsuModal">
                            Добавить блок питания
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="PsuModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Добавление блока питания</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.components.psu.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="model_id" value="{{ $models -> id }}">
                                        <div class="modal-body">
                                            {{--Название--}}
                                            <div class="mb-2">
                                                <label class="form-label">Название</label>
                                                <input class="form-control" type="text" name="name" placeholder="Название">
                                            </div>
                                            {{----}}

                                            {{--Модель--}}
                                            <div class="mb-2">
                                                <label class="form-label">Модель</label>
                                                <input class="form-control" type="text" name="model" placeholder="Модель">
                                            </div>
                                            {{----}}

                                            {{--Мощность--}}
                                            <div class="mb-2">
                                                <label class="form-label">Мощность</label>
                                                <input class="form-control" type="number" min="500" name="power" placeholder="Мощность">
                                            </div>
                                            {{----}}

                                            {{--Цена--}}
                                            <div class="mb-2">
                                                <label class="form-label">Цена</label>
                                                <input class="form-control" type="number" min="100" max="100000000" name="price" placeholder="Цена">
                                            </div>
                                            {{----}}

                                            {{--Изображение--}}
                                            <div class="mb-2">
                                                <label class="form-label">Изображение</label>
                                                <input class="form-control" type="file" name="img">
                                            </div>
                                            {{----}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                            <button type="submit" class="btn btn-primary">Добавить</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </container>
                    {{----}}
                    <div class="d-flex flex-wrap mb-5" style="column-gap: 130px; row-gap: 30px;">
                        @foreach($psus as $psu)
                            @if($psu -> ComputerModel -> name === $models -> name)
                                <div class="card" style="width: 22rem;">
                                    <div class="model-img">
                                        <img src="{{ asset('storage/img/component_photo/psu/' . $psu -> img ) }}" class="pt-3 w-100 h-100" alt="{{ $psu -> name }}">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $psu -> name }}</h5>
                                        {{--Изменения блока питания--}}
                                        <container>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#PsuModal{{ $psu -> id }}">
                                                Редактировать
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="PsuModal{{ $psu -> id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Редактирование блока питания</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('admin.components.psu.update', $psu -> id )}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="modal-body">
                                                                {{--Название--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Название</label>
                                                                    <input class="form-control" type="text" name="name" value="{{ $psu -> name }}">
                                                                </div>
                                                                {{----}}

                                                                {{--Модель--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Модель</label>
                                                                    <input class="form-control" type="text" name="model" value="{{ $psu -> model }}">
                                                                </div>
                                                                {{----}}

                                                                {{--Мощность--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Мощность</label>
                                                                    <input class="form-control" type="number" min="500" name="power" value="{{ $psu -> power }}">
                                                                </div>
                                                                {{----}}

                                                                {{--Цена--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Цена</label>
                                                                    <input class="form-control" type="number" min="100" max="100000000" name="price" value="{{ $psu -> price }}">
                                                                </div>
                                                                {{----}}

                                                                {{--Изображение--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Изображение</label>
                                                                    <input class="form-control" type="file" name="img">
                                                                </div>
                                                                {{----}}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                                                <button type="submit" class="btn btn-primary">Добавить</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </container>
                                        {{----}}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </container>
                {{--!!!!--}}
            </div>
        </div>
    </main>
@endsection
