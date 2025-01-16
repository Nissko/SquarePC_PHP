@extends('layouts.layout')
@section('title', 'Выбор комплектации')
@section('content')
    <link rel="stylesheet" href="{{asset('css/computer_assemblies-style.css')}}">
    <main class="o-main">
        <section class="c-section-info">
            <div class="c-hero">
                <div class="c-hero_image">
                    <img class="o-media-wrapper" src="{{ asset('img/Conf.jpg') }}" width="1920" height="1080">
                </div>
            </div>
            <div class="name_page-style">Комплектация</div>
        </section>
        <div class="content-legend container">
            <div>
                Выберите комплектацию:
            </div>
        </div>
        <div class="conf-flex-block container">
            @foreach($Assemblies as $build)
                <div class="conf-block conf-assemblies" data-aos="flip-up" data-aos-delay="50">
                    <div class="conf-img-block">
                        {{--<img class="conf-img" src="{{ asset('img/'. $build -> ComputerModel -> img).'.png' }}" width="1920px" height="1080px">--}}
                        <img class="conf-img" src="{{ asset('storage/img/package_photo/'. $build -> ComputerModel -> img)}}" alt="{{ $build -> ComputerModel -> name }}" width="100%" height="100%">
                    </div>
                    <div class="conf_name-conf">
                        {{ $build -> ComputerModel -> name }} - {{ $build -> package_name }}
                    </div>
                    <div class="conf_desk-assemblies">
                        <div class="component_pc component_pc-{{ $build -> id }}">
                            <div class="popup_heading">Основные комплектующие: </div>
                            <div class="popup_text">
                                {{-- CPU --}}
                                @foreach($build -> ComputerModel -> Cpu as $cpu)
                                    @if($build -> package_name === $cpu->complectation_name)
                                        <div title="Точные комплектующие уточняйте у менеджера">{{ $cpu -> name}}</div>
                                    @endif
                                @endforeach

                                {{-- Motherboard --}}
                                @foreach($build -> ComputerModel -> Motherboard as $motherboard)
                                    @if($build -> package_name === $motherboard->complectation_name)
                                        <div title="Точные комплектующие уточняйте у менеджера">{{ $motherboard -> name}}</div>
                                    @endif
                                @endforeach

                                {{-- RAM --}}
                                @foreach($build -> ComputerModel -> Ram as $ram)
                                    @foreach($ram -> positions as $ram_pos)
                                        @if($build -> package_name === $ram_pos->package_name)
                                            <div title="Точные комплектующие уточняйте у менеджера">{{ $ram_pos -> rams -> name}}</div>
                                        @endif
                                    @endforeach
                                @endforeach

                                {{-- GPU --}}
                                @foreach($build -> ComputerModel -> Gpu as $gpu)
                                    @if($build -> package_name === $gpu->complectation_name)
                                        <div title="Точные комплектующие уточняйте у менеджера">{{ $gpu -> name}}</div>
                                    @endif
                                @endforeach

                                {{-- PSU --}}
                                @foreach($build -> ComputerModel -> Psu as $psu)
                                    @foreach($psu -> positions as $psu_pos)
                                        @if($build -> package_name === $psu_pos -> package_name and $build -> ComputerModel -> name === $psu_pos -> model_name)
                                            <div title="Точные комплектующие уточняйте у менеджера">{{ $psu_pos -> psuses -> name}}</div>
                                        @endif
                                    @endforeach
                                @endforeach

                                {{-- Corp --}}
                                @foreach($build -> ComputerModel -> Corp as $corp)
                                    <div title="Точные комплектующие уточняйте у менеджера">{{ $corp -> name}}</div>
                                @endforeach
                            </div>
                        </div>
                        <a class="open_components-{{ $build -> id }}">Характеристики <img class="conf_desk-assemblies_img" src="{{ asset('img/info_ico.png') }}" alt="Узнать подробнее о сборке"></a>
                    </div>
                    <div class="conf_price">
                        Цена от <b>{{ $build -> price + 0 }}</b> рублей
                    </div>
                    @foreach($build->stat as $stat)
                    <div class="skill">
                        <div class="skill-name">
                            {{ $stat -> stat_name }}
                        </div>
                        <div class="skill-bar">
                            <div class="skill-per" per="{{ $stat -> stat_value }} FPS" style="max-width: {{ $stat -> stat_value }}%;"></div>
                        </div>
                    </div>
                    @endforeach
                    <div class="btn-assemblies">
{{--                        @if($data -> role == 'guest')
                            <a href="{{ route('login') }}">
                                <button title="Авторизируйтесь, чтобы купить!" class="buy_assemblies buy_assemblies-danger">Авторизируйтесь</button>
                            </a>
                        @endif--}}

                        @if($build->count > 0)
                            @if($data -> role === 'guest')
                                <a href="{{ route('login') }}">
                                    <button title="Авторизируйтесь, чтобы купить!" class="buy_assemblies buy_assemblies-danger">Авторизируйтесь</button>
                                </a>
                            @endif
                            @if($data -> role === 'user' or $data -> role === 'admin')
                                @if(\Cart::get($build -> id))
                                    <button class="buy_assemblies in_cart_btn">В корзине</button>
                                @else
                                    <button class="buy_assemblies buy_assemblies-{{ $build -> id }}" data-id="{{ $build -> id }}" data-complectation="{{ $build -> package_name }}" data-buildname="{{ $build -> ComputerModel -> name }}">Купить</button>
                                @endif
                            @endif
                        @else
                            <button title="Товар закончился!" class="buy_assemblies buy_assemblies-danger">Нет в наличии</button>
                        @endif

                        <a href="{{ route('configurator_page', [$build -> model_id, $build -> ComputerModel -> name, $build -> package_name]) }}">
                            <button class="configurate_assemblies configurate_assemblies-{{ $build -> id }}">Конфигурировать</button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
    <script>
        $(document).ready(function () {
            for (let i = 0; i <= 99; i++){
                $('.buy_assemblies-'+i).click(function (event) {
                    let id = $('.buy_assemblies-'+i).data('id');
                    let complectation = $('.buy_assemblies-'+i).data('complectation');
                    let build_name = $('.buy_assemblies-'+i).data('buildname')
                    addToCart(id, complectation, build_name);
                    $('.buy_assemblies-'+i).text('Товар добавлен');
                });

                $('.open_components-'+i).click(function() {
                    $(this).toggleClass('open');
                    $('.component_pc-'+i).slideToggle();
                });
            }
        })

        function addToCart(id, complectation, build_name){

            $.ajax({
                url: '{{ route('addToCart')}}',
                type: "POST",
                data: {
                    id: id,
                    complectation: complectation,
                    build_name: build_name,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    console.log(data)
                }
            });
        }
    </script>
    <script src="{{ asset('script/blade-pattern/hover_btn-assemblies.js') }}"></script>
    <script src="{{ asset('script/scroll-top-menu.js') }}"></script>
@endsection
