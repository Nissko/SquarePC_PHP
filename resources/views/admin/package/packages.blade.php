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
            <div class="name_page-style">Управление сборками</div>
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
            {{-- Модели --}}
            <container class="model-container">
                <div class="pt-5 pb-3 fs-3 heading-functional">
                    {{--Действие--}}
                    Управление моделями
                </div>
                {{-- Добавление модели --}}
                <div class="pb-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">
                        Добавить
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Добавление модели</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.package.model.create') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        @csrf
                                        <label class="form-label">Название</label>
                                        <input type="text" name="model_name" class="form-control mb-3" placeholder="Название модели" required>

                                        <label class="form-label">Описание</label>
                                        <textarea class="form-control mb-3" maxlength="100" name="model_description" rows="1" placeholder="Описание модели" required></textarea>

                                        <label class="form-label">Изображение</label>
                                        <input type="file" name="model_img" class="form-control" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Отмена</button>
                                        <button type="submit" class="btn btn-primary">Добавить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-wrap admin-action-content">
                    {{--Вывод действия--}}
                    @foreach($configuration_models as $model)
                        <div class="card" style="width: 18rem;">
                            <div class="model-img">
                                <img src="{{ asset('storage/img/package_photo/'. $model -> img)}}" class="card-img-top" alt="{{ $model -> name }}">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $model -> name }}</h5>
                                <p class="card-text">{{ $model -> description }}</p>
                                {{-- Редактирование модели --}}
                                <div class="w-100">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$model->id}}">
                                        Редактировать
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop{{$model->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Редактирование модели</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.package.model.update', $model->id) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-body">
                                                        <label class="form-label">Название</label>
                                                        <input type="text" name="model_name" class="form-control mb-3" value="{{ $model -> name }}">

                                                        <label class="form-label">Описание</label>
                                                        <textarea class="form-control mb-3" maxlength="100" name="model_description">{{ $model -> description }}</textarea>

                                                        <label class="form-label">Изображение</label>
                                                        <input type="file" name="model_img" class="form-control">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Отмена</button>
                                                        <button type="submit" class="btn btn-primary">Изменить</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </container>

            {{-- Сборки --}}
            <container class="model-container">
                <div class="pt-5 pb-3 fs-3 heading-functional">
                    {{--Действие--}}
                    Управление готовыми сборками
                </div>
                {{-- Добавление сборки --}}
                <div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#packageBackdropAdd">
                        Добавить сборку
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="packageBackdropAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Добавление конфигурации</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form class="form-control" action="{{ route('admin.package.model.component.store') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <label for="package_model" class="form-label">Модель:</label>
                                        <select id="package_model" name="model_id" class="form-select mb-3" required>
                                            <option selected disabled>Выберите модель:</option>
                                            @foreach($configuration_models as $model)
                                                <option value="{{ $model -> id }}">{{ $model -> name }}</option>
                                            @endforeach
                                        </select>

                                        <label for="package_complectation" class="form-label">Название комплектации:</label>
                                        <select id="package_complectation" class="form-select mb-3" name="package_name" required>
                                            <option selected disabled>Выберите комплектацию</option>
                                            <option value="START">START</option>
                                            <option value="PLUS">PLUS</option>
                                            <option value="MAX">MAX</option>
                                        </select>

                                        <label for="package_description" class="form-label">Описание:</label>
                                        <textarea id="package_description" class="form-control mb-3" name="description" rows="2" placeholder="Описание комплектации" required></textarea>

                                        <label for="package_recommendation" class="form-label">Актуальность:</label>
                                        <textarea id="package_recommendation" class="form-control mb-3" maxlength="100" name="recommendation" rows="2" placeholder="Для каких лучше задач подходит" required></textarea>

                                        <label for="package_count_ram" class="form-label">Количество ОЗУ</label>
                                        <input id="package_count_ram" type="number" name="qty_ram" class="form-control mb-3" min="1" max="4" value="1" required>

                                        <label for="package_qty" class="form-label">Количество в наличии</label>
                                        <input id="package_qty" type="number" name="count" class="form-control mb-3" min="1" max="100" value="1" required>

                                        {{--Комплектующие--}}
                                        <div class="component_package_store"></div>
                                        {{----}}

                                        <div class="stat fs-5">Cтатистика:</div>
                                        <div>
                                            <label for="stat1" class="form-label fw-bold">1080P</label>
                                            <input id="stat1" class="form-control mb-2" type="number" min="1" max="10000" name="stat1" placeholder="Введите количество FPS">

                                            <label for="stat2" class="form-label fw-bold">1440P</label>
                                            <input id="stat2" class="form-control mb-2" type="number" min="1" max="10000" name="stat2" placeholder="Введите количество FPS">

                                            <label for="stat3" class="form-label fw-bold">2160P</label>
                                            <input id="stat3" class="form-control mb-2" type="number" min="1" max="10000" name="stat3" placeholder="Введите количество FPS">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Отмена</button>
                                        <button type="submit" class="btn btn-primary">Добавить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{----}}
                <div class="d-flex flex-wrap admin-action-content">
                    {{--Вывод действия--}}
                    @foreach($configuration_packages as $package)
                        <div class="card" style="width: 18rem;">
                            <div class="model-img">
                                <img src="{{ asset('storage/img/package_photo/'. $package -> ComputerModel -> img)}}" class="card-img-top" alt="{{ $package -> name }}">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $package -> ComputerModel -> name }} - {{ $package -> package_name }}</h5>
                                <p class="card-text card-text-package">{{ $package -> description }}</p>
                                {{-- Редактирование сборки --}}
                                <div class="w-100">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#packageBackdrop{{ $package->id }}">
                                        Редактировать
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="packageBackdrop{{ $package->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Редактирование сборки</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-control">
                                                        {{--<label for="package_model" class="form-label">Название модели:</label>
                                                        <select id="package_model" class="form-select mb-3">
                                                            <option selected disabled>{{ $package -> ComputerModel -> name }}</option>
                                                            @foreach($configuration_models as $model)
                                                                <option>{{ $model -> name }}</option>
                                                            @endforeach
                                                        </select>

                                                        <label for="package_complectation" class="form-label">Название комплектации:</label>
                                                        <input id="package_complectation" type="text" name="package_name" class="form-control mb-3" maxlength="20" value="{{ $package -> package_name }}">--}}

                                                        <label for="package_description" class="form-label">Описание:</label>
                                                        <textarea id="package_description" class="form-control mb-3" name="package_description" rows="2">{{ $package -> description }}</textarea>

                                                        <label for="package_recommendation" class="form-label">Актуальность:</label>
                                                        <textarea id="package_recommendation" class="form-control mb-3" maxlength="100" name="package_rec" rows="2">{{ $package -> recommendation }}</textarea>

                                                        <label for="package_count_ram" class="form-label">Количество ОЗУ:</label>
                                                        <input id="package_count_ram" type="number" name="package_qty_ram" class="form-control mb-3" min="1" max="4" value="{{ $package -> qty_ram }}">

                                                        {{--Сделать автоматическую цену, то есть от выбранных комплектующих--}}
                                                        {{--<label for="package_count_ram" class="form-label">Цена:</label>
                                                        <input id="package_count_ram" type="text" name="package_price" class="form-control mb-3" value="{{ $package -> price }}">--}}

                                                        <label for="package_qty" class="form-label">Количество в наличии:</label>
                                                        <input id="package_qty" type="number" name="package_count" class="form-control mb-3" min="1" max="100" value="{{ $package -> count }}">

                                                        <div class="fs-5 fw-bold">Комплектующие готовой конфигурации:</div>
                                                        {{--Комлектующие конфигурации--}}
                                                        <div>
                                                            @foreach($configuration_positions as $position)
                                                                @if( $package -> package_name === $position-> package_name and $package -> ComputerModel -> name === $position-> model_name)
                                                                    <label for="cpu" class="form-label">Процессор:</label>
                                                                    <select id="cpu" class="form-select mb-3" name="package_cpu">
                                                                        <option selected disabled>{{ $position -> cpuses -> name }}</option>
                                                                        @foreach($configuration_cpus as $cpu)
                                                                            @if($package -> ComputerModel -> name === $cpu -> ComputerModel -> name)
                                                                                <option value="{{ $cpu -> id }}">{{ $cpu -> name }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>

                                                                    <label for="motherboard" class="form-label">Материнская плата:</label>
                                                                    <select id="motherboard" class="form-select mb-3" name="package_motherboard">
                                                                        <option selected disabled>{{ $position -> motherboardses -> name }} ({{ $position -> motherboardses -> brand }})</option>
                                                                        @foreach($configuration_motherboards as $motherboard)
                                                                            @if($package -> ComputerModel -> name === $motherboard -> ComputerModel -> name)
                                                                                <option value="{{ $motherboard -> id }}">{{ $motherboard -> name }} ({{ $motherboard -> brand }})</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>

                                                                    <label for="ram" class="form-label">ОЗУ:</label>
                                                                    <select id="ram" class="form-select mb-3" name="package_ram">
                                                                        <option selected disabled>{{ $position -> rams -> name }}</option>
                                                                        @foreach($configuration_rams as $ram)
                                                                            @if($package -> ComputerModel -> name === $ram -> ComputerModel -> name)
                                                                                <option value="{{ $ram -> id }}">{{ $ram -> name }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>

                                                                    <label for="gpu" class="form-label">Видеокарта:</label>
                                                                    <select id="gpu" class="form-select mb-3" name="package_gpu">
                                                                        <option selected disabled>{{ $position -> gpuses -> name }}</option>
                                                                        @foreach($configuration_gpus as $gpu)
                                                                            @if($package -> ComputerModel -> name === $gpu -> ComputerModel -> name)
                                                                                <option value="{{ $gpu -> id }}">{{ $gpu -> name }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>

                                                                    <label for="psu" class="form-label">Блок питания:</label>
                                                                    <select id="psu" class="form-select mb-3" name="package_psu">
                                                                        <option selected disabled>{{ $position -> psuses -> name }}</option>
                                                                        @foreach($configuration_psus as $psu)
                                                                            @if($package -> ComputerModel -> name === $psu -> ComputerModel -> name)
                                                                                <option value="{{ $psu -> id }}">{{ $psu -> name }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>

                                                                    <label for="hdd" class="form-label">Жесткий диск:</label>
                                                                    <select id="hdd" class="form-select mb-3" name="package_hdd">
                                                                        <option selected disabled>{{ $position -> disks -> name }}</option>
                                                                        @foreach($configuration_disks as $disk)
                                                                            @if($disk -> type === "HDD")
                                                                                <option value="{{ $disk -> id }}">{{ $disk -> name }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>

                                                                    <label for="ssd" class="form-label">Твердотельный накопитель:</label>
                                                                    <select id="ssd" class="form-select mb-3" name="package_ssd">
                                                                        <option selected disabled>{{ $position -> ssds -> name }}</option>
                                                                        @foreach($configuration_disks as $disk)
                                                                            @if($disk -> type === "SSD")
                                                                                <option value="{{ $disk -> id }}">{{ $disk -> name }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>

                                                                    <label for="cooling" class="form-label">Система охлаждения:</label>
                                                                    <select id="cooling" class="form-select mb-3" name="package_cooling">
                                                                        <option selected disabled>{{ $position -> coolings -> name }}</option>
                                                                        @foreach($configuration_coolings as $cooling)
                                                                            <option value="{{ $cooling -> id }}">{{ $cooling -> name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                            @endforeach
                                                            @foreach( $configuration_cases as $case )
                                                                @if($package -> ComputerModel -> name === $case -> ComputerModel -> name)
                                                                    <label class="form-label">Корпус:</label>
                                                                    <select class="form-select mb-3">
                                                                        <option selected disabled>{{ $case -> name }}</option>
                                                                    </select>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        {{----}}
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Отмена</button>
                                                    <button type="button" class="btn btn-primary">Изменить</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{----}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </container>
        </div>
    </main>

    <script>
        $(document).ready(function () {
            $('#package_model').change(function (event) {
                let model_id = $(this).val();
                console.log(model_id);
                SetComponentModel(model_id)
            });
        })

        //Вывод комлектующих для модели
        function SetComponentModel(model_id){
            $.ajax({
                url: '{{ route('admin.package.model.component_package_store')}}',
                type: "POST",
                data: {
                    model: model_id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $('.component_package_store').html(data.options);
                },
                error: (error) => {
                    console.log(JSON.stringify(error));
                }
            });
        }
    </script>
@endsection
