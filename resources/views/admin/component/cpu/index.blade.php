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
                Управление комплектующими: <span class="fs-3 fw-bold">{{ $models -> name }} - Процессоры</span>
            </div>
            <div class="d-flex flex-wrap admin-action-content">
                {{--Процессоры--}}
                <container>
                    <div class="fs-3 pb-2">Процессоры</div>
                    {{--Добавление процессора--}}
                    <container>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#CpuModal">
                            Добавить процессор
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="CpuModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Добавление процессора</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.components.cpu.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="model_id" value="{{ $models -> id }}">
                                        <div class="modal-body">
                                            {{--Название--}}
                                            <div class="mb-2">
                                                <label class="form-label">Название</label>
                                                <input class="form-control" type="text" name="name" placeholder="Название процессора">
                                            </div>
                                            {{----}}

                                            {{--Модель--}}
                                            <div class="mb-2">
                                                <label class="form-label">Модель</label>
                                                <input class="form-control" type="text" name="model" placeholder="Модель процессора">
                                            </div>
                                            {{----}}

                                            {{--Количество ядер--}}
                                            <div class="mb-2">
                                                <label class="form-label">Количество ядер</label>
                                                <input class="form-control" type="number" min="2" max="32" name="core" placeholder="Количество ядер">
                                            </div>
                                            {{----}}

                                            {{--Количество потоков--}}
                                            <div class="mb-2">
                                                <label class="form-label">Количество потоков</label>
                                                <input class="form-control" type="number" min="2" max="64" name="threads" placeholder="Количество потоков">
                                            </div>
                                            {{----}}

                                            {{--Минимальная частота--}}
                                            <div class="mb-2">
                                                <label class="form-label">Базовая частота</label>
                                                <input class="form-control" type="number" min="2000" max="6000" name="min_clock" placeholder="Частота">
                                            </div>
                                            {{----}}

                                            {{--Турбо частота--}}
                                            <div class="mb-2">
                                                <label class="form-label">Максимальная частота</label>
                                                <input class="form-control" type="number" min="2000" max="6000" name="max_clock" placeholder="Максимальная частота">
                                            </div>
                                            {{----}}

                                            {{--Сокет--}}
                                            <div class="mb-2">
                                                <label class="form-label">Сокет</label>
                                                <input class="form-control" type="text" name="socket" placeholder="Сокет">
                                            </div>
                                            {{----}}

                                            {{--Тепловыделение--}}
                                            <div class="mb-2">
                                                <label class="form-label">TDP</label>
                                                <input class="form-control" type="number" min="1" max="1000" name="TDP" placeholder="Тепловыделение">
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
                        @foreach($cpus as $cpu)
                            @if($cpu -> ComputerModel -> name === $models -> name)
                                <div class="card" style="width: 22rem;">
                                    <div class="model-img">
                                        <img src="{{ asset('storage/img/component_photo/cpu/' . $cpu -> img ) }}" class="pt-3 w-100 h-100" alt="{{ $cpu -> name }}">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $cpu -> name }}</h5>
                                        @if( $cpu -> complectation_name !== null )
                                            <p class="card-text">Используется в конфигурации: {{ $cpu -> complectation_name }}</p>
                                        @else
                                            <p class="card-text">Не используется в готовой конфигурации</p>
                                        @endif
                                        {{--Изменение процессора--}}
                                        <container>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#CpuModalEdit{{$cpu->id}}">
                                                Редактировать
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="CpuModalEdit{{$cpu->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Редактирование процессора</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('admin.components.cpu.update', $cpu -> id )}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="modal-body">
                                                                {{--Название--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Название</label>
                                                                    <input class="form-control" type="text" name="name" value="{{ $cpu -> name }}">
                                                                </div>
                                                                {{----}}

                                                                {{--Модель--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Модель</label>
                                                                    <input class="form-control" type="text" name="model" value="{{ $cpu -> model }}">
                                                                </div>
                                                                {{----}}

                                                                {{--Количество ядер--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Количество ядер</label>
                                                                    <input class="form-control" type="number" min="2" max="32" name="core" value="{{ $cpu -> core }}">
                                                                </div>
                                                                {{----}}

                                                                {{--Количество потоков--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Количество потоков</label>
                                                                    <input class="form-control" type="number" min="2" max="64" name="threads" value="{{ $cpu -> threads }}">
                                                                </div>
                                                                {{----}}

                                                                {{--Минимальная частота--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Базовая частота</label>
                                                                    <input class="form-control" type="number" min="2000" max="6000" name="min_clock" value="{{ $cpu -> min_clock }}">
                                                                </div>
                                                                {{----}}

                                                                {{--Турбо частота--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Максимальная частота</label>
                                                                    <input class="form-control" type="number" min="2000" max="6000" name="max_clock" value="{{ $cpu -> max_clock }}">
                                                                </div>
                                                                {{----}}

                                                                {{--Сокет--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Сокет</label>
                                                                    <input class="form-control" type="text" name="socket" value="{{ $cpu -> socket }}">
                                                                </div>
                                                                {{----}}

                                                                {{--Тепловыделение--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">TDP</label>
                                                                    <input class="form-control" type="number" min="1" max="1000" name="TDP" value="{{ $cpu -> TDP }}">
                                                                </div>
                                                                {{----}}

                                                                {{--Цена--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Цена</label>
                                                                    <input class="form-control" type="number" min="100" max="100000000" name="price" value="{{ $cpu -> price }}">
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
