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
                Управление комплектующими: <span class="fs-3 fw-bold">{{ $models -> name }} - Материнские платы</span>
            </div>
            <div class="d-flex flex-wrap admin-action-content">
                {{--Материнские платы--}}
                <container>
                    <div class="fs-3 pb-2">Материнские платы</div>
                    {{--Добавление материнской платы--}}
                    <container>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#CpuMotherboard">
                            Добавить материнскую плату
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="CpuMotherboard" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Добавление материнской платы</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.components.motherboard.store') }}" method="post" enctype="multipart/form-data">
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

                                            {{--Сокет--}}
                                            <div class="mb-2">
                                                <label class="form-label">Сокет</label>
                                                <input class="form-control" type="text" name="socket" placeholder="Сокет">
                                            </div>
                                            {{----}}

                                            {{--Чипсет--}}
                                            <div class="mb-2">
                                                <label class="form-label">Чипсет</label>
                                                <input class="form-control" type="text" name="chipset" placeholder="Чипсет">
                                            </div>
                                            {{----}}

                                            {{--Размер--}}
                                            <div class="mb-2">
                                                <label class="form-label">Форм-фактор</label>
                                                <select class="form-select" name="size">
                                                    <option selected disabled>Размер мат.платы</option>
                                                    <option value="E-ATX">E-ATX</option>
                                                    <option value="Micro-ATX">Micro-ATX</option>
                                                    <option value="Mini-DTX">Mini-DTX</option>
                                                    <option value="Mini-ITX">Mini-ITX</option>
                                                    <option value="Standard-ATX">Standart-ATX</option>
                                                </select>
                                            </div>
                                            {{----}}

                                            {{--Количество слотов ОЗУ--}}
                                            <div class="mb-2">
                                                <label class="form-label">Количество слотов ОЗУ</label>
                                                <select class="form-select" name="qty_ram">
                                                    <option selected disabled>Выберите кол-во слотов ОЗУ</option>
                                                    <option value="2">2</option>
                                                    <option value="4">4</option>
                                                </select>
                                            </div>
                                            {{----}}

                                            {{--Бренд--}}
                                            <div class="mb-2">
                                                <label class="form-label">Производитель чипсета</label>
                                                <select class="form-select" name="brand">
                                                    <option selected disabled>Выберите производителя чипсета</option>
                                                    <option value="AMD">AMD</option>
                                                    <option value="INTEL">INTEL</option>
                                                </select>
                                            </div>
                                            {{----}}

                                            {{--Максимальная частота без разгона--}}
                                            <div class="mb-2">
                                                <label class="form-label">Максимальная частота памяти(без разгона)</label>
                                                <input class="form-control" type="number" min="2667" max="6000" name="max_clock_ram" placeholder="Частота памяти">
                                            </div>
                                            {{----}}

                                            {{--Слоты M2--}}
                                            <div class="mb-2">
                                                <label class="form-label">Количество разъемов M.2</label>
                                                <input class="form-control" type="number" min="1" max="4" name="m2_slots_qty" placeholder="Количество разъемов M.2">
                                            </div>
                                            {{----}}

                                            {{--Слоты SATA--}}
                                            <div class="mb-2">
                                                <label class="form-label">Количество портов SATA</label>
                                                <input class="form-control" type="number" min="4" max="8" name="sata_slots_qty" placeholder="Количество портов SATA">
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
                        @foreach($motherboards as $motherboard)
                            @if($motherboard -> ComputerModel -> name === $models -> name)
                                <div class="card" style="width: 22rem;">
                                    <div class="model-img">
                                        <img src="{{ asset('storage/img/component_photo/motherboard/' . $motherboard -> img ) }}" class="pt-3 w-100 h-100" alt="{{ $motherboard -> name }}">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $motherboard -> name }}</h5>
                                        @if( $motherboard -> complectation_name !== null )
                                            <p class="card-text">Используется в конфигурации: {{ $motherboard -> complectation_name }}</p>
                                        @else
                                            <p class="card-text">Не используется в готовой конфигурации</p>
                                        @endif
                                        {{--Изменение материнской платы--}}
                                        <container>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#CpuMotherboard{{$motherboard->id}}">
                                                Редактировать
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="CpuMotherboard{{$motherboard->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Добавление материнской платы</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('admin.components.motherboard.update', $motherboard -> id )}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="modal-body">
                                                                {{--Название--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Название</label>
                                                                    <input class="form-control" type="text" name="name" value="{{ $motherboard -> name }}">
                                                                </div>
                                                                {{----}}

                                                                {{--Модель--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Модель</label>
                                                                    <input class="form-control" type="text" name="model" value="{{ $motherboard -> model }}">
                                                                </div>
                                                                {{----}}

                                                                {{--Сокет--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Сокет</label>
                                                                    <input class="form-control" type="text" name="socket" value="{{ $motherboard -> socket }}">
                                                                </div>
                                                                {{----}}

                                                                {{--Чипсет--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Чипсет</label>
                                                                    <input class="form-control" type="text" name="chipset" value="{{ $motherboard -> chipset }}">
                                                                </div>
                                                                {{----}}

                                                                {{--Размер--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Форм-фактор</label>
                                                                    <select class="form-select" name="size">
                                                                        <option selected disabled>{{ $motherboard -> size }}</option>
                                                                        <option value="E-ATX">E-ATX</option>
                                                                        <option value="Micro-ATX">Micro-ATX</option>
                                                                        <option value="Mini-DTX">Mini-DTX</option>
                                                                        <option value="Mini-ITX">Mini-ITX</option>
                                                                        <option value="Standard-ATX">Standart-ATX</option>
                                                                    </select>
                                                                </div>
                                                                {{----}}

                                                                {{--Количество слотов ОЗУ--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Количество слотов ОЗУ</label>
                                                                    <select class="form-select" name="qty_ram">
                                                                        <option selected disabled>{{ $motherboard -> qty_ram }}</option>
                                                                        <option value="2">2</option>
                                                                        <option value="4">4</option>
                                                                    </select>
                                                                </div>
                                                                {{----}}

                                                                {{--Бренд--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Производитель чипсета</label>
                                                                    <select class="form-select" name="brand">
                                                                        <option selected disabled>{{ $motherboard -> brand }}</option>
                                                                        <option value="AMD">AMD</option>
                                                                        <option value="INTEL">INTEL</option>
                                                                    </select>
                                                                </div>
                                                                {{----}}

                                                                {{--Максимальная частота без разгона--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Максимальная частота памяти(без разгона)</label>
                                                                    <input class="form-control" type="number" min="2667" max="6000" name="max_clock_ram" value="{{ $motherboard -> max_clock_ram }}">
                                                                </div>
                                                                {{----}}

                                                                {{--Слоты M2--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Количество разъемов M.2</label>
                                                                    <input class="form-control" type="number" min="1" max="4" name="m2_slots_qty" value="{{ $motherboard -> m2_slots_qty }}">
                                                                </div>
                                                                {{----}}

                                                                {{--Слоты SATA--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Количество портов SATA</label>
                                                                    <input class="form-control" type="number" min="4" max="8" name="sata_slots_qty" value="{{ $motherboard -> sata_slots_qty }}">
                                                                </div>
                                                                {{----}}

                                                                {{--Цена--}}
                                                                <div class="mb-2">
                                                                    <label class="form-label">Цена</label>
                                                                    <input class="form-control" type="number" min="100" max="100000000" name="price" value="{{ $motherboard -> price }}">
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
