@extends('layouts.layout')
@section('title', 'Конфигурирование')
@section('content')
    <link rel="stylesheet" href="{{asset('css/configurator_page-style.css')}}">
    <main class="o-main">
        <section class="c-section-info">
            <div class="c-hero">
                <div class="c-hero_image">
                    <img class="o-media-wrapper" src="{{ asset('img/Conf.jpg') }}" width="1920" height="1080">
                </div>
            </div>
            <div class="name_page-style">Создание сборки</div>
        </section>
        <form method="post" action="{{ route('configurations.store') }}">
            @if(session()->has('success'))
                <div class="style_error_configurator_page">{{ session()->get('success') }}</div>
            @endif
            @csrf
            <div class="configurator_page-flex-block container-md" data-aos="flip-up" data-aos-delay="50">
                <div class="configurator_page-flex-block-row-1">
                    <div class="cpu-select-div abc" id="cpu-select-div" data-aos="flip-down" data-aos-delay="500" data-aos-once="true">
                            <div class="select-name-div">Процессор:</div>
                            <select required class="cpu-select-select cpu" id="cpuses" name="cpu_id">
                                @foreach($cpuses as $cpu)
                                    @if($complectation_name === 'START')
                                        @if($cpu -> complectation_name === 'START')
                                            <option selected value="{{ $cpu -> id }}" data-socket="{{ $cpu -> socket }}" data-price='{{$cpu -> price}}'>{{ $cpu -> model}}</option>
                                        @else
                                            <option id="option_cpu" value="{{ $cpu -> id }}" data-socket="{{ $cpu -> socket }}" data-price='{{$cpu -> price}}'>{{ $cpu -> model}}</option>
                                        @endif
                                    @elseif($complectation_name === 'PLUS')
                                        @if($cpu -> complectation_name === 'PLUS')
                                            <option selected value="{{ $cpu -> id }}" data-socket="{{ $cpu -> socket }}" data-price='{{$cpu -> price}}'>{{ $cpu -> model}}</option>
                                        @else
                                            <option id="option_cpu" value="{{ $cpu -> id }}" data-socket="{{ $cpu -> socket }}" data-price='{{$cpu -> price}}'>{{ $cpu -> model}}</option>
                                        @endif
                                    @elseif($complectation_name === 'MAX')
                                        @if($cpu -> complectation_name === 'MAX')
                                            <option selected value="{{ $cpu -> id }}" data-socket="{{ $cpu -> socket }}" data-price='{{$cpu -> price}}'>{{ $cpu -> model}}</option>
                                        @else
                                            <option id="option_cpu" value="{{ $cpu -> id }}" data-socket="{{ $cpu -> socket }}" data-price='{{$cpu -> price}}'>{{ $cpu -> model}}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                    </div>
                    <div class="ram-select-div abc" id="ram-select-div" data-aos="flip-up" data-aos-delay="500" data-aos-once="true">
                        <div class="select-name-div">Оперативная память:</div>
                        <select class="ram-select-select" id="rams" name="ram_id">
                            @foreach($rams as $ram)
                                @if($ram -> id !== 0)
                                        <option value="{{ $ram -> id }}" data-price='{{ $ram -> price }}'>{{ $ram -> model }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="configurator_page-flex-block-row-2">
                    <div class="gpu-select-div abc" id="gpu-select-div" data-aos="flip-up" data-aos-delay="500" data-aos-once="true">
                        <div class="select-name-div">Видеокарта:</div>
                        <select class="gpu-select-select" id="gpuses" name="gpu_id">
                            @foreach($gpuses as $gpu)
                                @if($complectation_name === 'START')
                                    @if($gpu -> complectation_name === 'START')
                                        <option selected value="{{ $gpu -> id }}" data-price='{{ $gpu -> price }}'>{{ $gpu -> model }}</option>
                                    @else
                                        <option value="{{ $gpu -> id }}" data-price='{{ $gpu -> price }}'>{{ $gpu -> model }}</option>
                                    @endif
                                @elseif($complectation_name === 'PLUS')
                                    @if($gpu -> complectation_name === 'PLUS')
                                        <option selected value="{{ $gpu -> id }}" data-price='{{ $gpu -> price }}'>{{ $gpu -> model }}</option>
                                    @else
                                        <option value="{{ $gpu -> id }}" data-price='{{ $gpu -> price }}'>{{ $gpu -> model }}</option>
                                    @endif
                                @elseif($complectation_name === 'MAX')
                                    @if($gpu -> complectation_name === 'MAX')
                                        <option selected value="{{ $gpu -> id }}" data-price='{{ $gpu -> price }}'>{{ $gpu -> model }}</option>
                                    @else
                                        <option value="{{ $gpu -> id }}" data-price='{{ $gpu -> price }}'>{{ $gpu -> model }}</option>
                                    @endif
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="motherboard-select-div abc" id="motherboard-select-div" data-aos="flip-up" data-aos-delay="500" data-aos-once="true">
                        <div class="select-name-div">Материнская плата:</div>
                        <select required="" class="motherboard-select-select motherboard" id="motherboard" name="motherboard_id">
                            @foreach($motherboardses as $motherboard)
                                @foreach($qtyconf as $qty_conf)
                                    @if($complectation_name === 'START')
                                        @if($motherboard -> complectation_name === 'START')
                                            <option selected value="{{ $motherboard -> id }}" data-socket="{{ $motherboard -> socket }}" data-price='{{ $motherboard -> price }}' data-qtyram='{{ $motherboard -> qty_ram }}' data-qtyramconf="{{ $qty_conf -> qty_ram }}">{{ $motherboard -> model }}</option>
                                        @else
                                            <option value="{{ $motherboard -> id }}" data-socket="{{ $motherboard -> socket }}" data-price='{{ $motherboard -> price }}' data-qtyram='{{ $motherboard -> qty_ram }}'>{{ $motherboard -> model }}</option>
                                        @endif
                                    @elseif($complectation_name === 'PLUS')
                                        @if($motherboard -> complectation_name === 'PLUS')
                                            <option selected value="{{ $motherboard -> id }}" data-socket="{{ $motherboard -> socket }}" data-price='{{ $motherboard -> price }}' data-qtyram='{{ $motherboard -> qty_ram }}' data-qtyramconf="{{ $qty_conf -> qty_ram }}">{{ $motherboard -> model }}</option>
                                        @else
                                            <option value="{{ $motherboard -> id }}" data-socket="{{ $motherboard -> socket }}" data-price='{{ $motherboard -> price }}' data-qtyram='{{ $motherboard -> qty_ram }}'>{{ $motherboard -> model }}</option>
                                        @endif
                                    @elseif($complectation_name === 'MAX')
                                        @if($motherboard -> complectation_name === 'MAX')
                                            <option selected value="{{ $motherboard -> id }}" data-socket="{{ $motherboard -> socket }}" data-price='{{ $motherboard -> price }}' data-qtyram='{{ $motherboard -> qty_ram }}' data-qtyramconf="{{ $qty_conf -> qty_ram }}">{{ $motherboard -> model }}</option>
                                        @else
                                            <option value="{{ $motherboard -> id }}" data-socket="{{ $motherboard -> socket }}" data-price='{{ $motherboard -> price }}' data-qtyram='{{ $motherboard -> qty_ram }}'>{{ $motherboard -> model }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="configurator_page-flex-block-2 container">
                <div class="configurator_page-flex-block2-row-1">
                    <div class="block-count-ram abc" data-aos="fade-down-right" data-aos-once="true">
                        <div class="select-name-div">Количество планок оперативной памяти:</div>
                        <select class="count-ram-select-select" id="count_rams" name="count_ram">

                        </select>
                    </div>
                    <div class="block-psu abc" data-aos="fade-down-left" data-aos-once="true">
                        <div class="select-name-div">Блок питания:</div>
                        <select class="psu-select-select" id="psuses" name="psu_id">
                            @foreach($psuses as $psu)
                                @if($psu -> id !== null)
                                    <option value="{{ $psu -> id }}" data-price='{{ $psu -> price }}'>{{ $psu -> model }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="configurator_page-flex-block-3 container">
                <div class="block-hard-drive abc" data-aos="fade-up-right" data-aos-once="true">
                    <div class="select-name-div">Жесткий диск:</div>
                    <select class="hard-select-select" id="hdd" name="disk_id">
                        @foreach($disks as $disk)
                            @if($disk -> id !== null && $disk -> type === "HDD")
                                <option value="{{ $disk -> id }}" data-price='{{ $disk -> price }}'>{{ $disk -> model }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="block-solide-drive abc" data-aos="fade-up" data-aos-once="true">
                    <div class="select-name-div">SSD диск:</div>
                    <select class="solide-select-select" id="ssd" name="ssd_id">
                        @foreach($disks as $disk)
                            @if($disk -> id !== null && $disk -> type === "SSD")
                                <option value="{{ $disk -> id }}" data-price='{{ $disk -> price }}'>{{ $disk -> model }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="block-hard-drive abc" data-aos="fade-up-left" data-aos-once="true">
                    <div class="select-name-div">Система охлаждения:</div>
                    <select class="cooling-select-select" id="cooling" name="cooling_id">
                        @foreach($coolings as $cooling)
                            @if($cooling -> id !== null )
                                <option value="{{ $cooling -> id }}" data-price='{{ $cooling -> price }}'>{{ $cooling -> model }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="configurator_page-submit_buttons container" data-aos="fade-up" data-aos-once="true">
                @if($data -> role === 'guest')
                    <a href="{{ route('login') }}" class="buy-btn_configurator" title="Авторизируйтесь, чтобы сконфигурировать">
                        Добавить в корзину
                    </a>
                @endif
                @if($data -> role === 'user' or $data -> role === 'admin')
                    <button type="submit" class="buy-btn_configurator">
                        Добавить в корзину
                    </button>
                @endif
                <div class="configurator_page-price_div">
                    <span class="configurator_page-price_span_text_price">Цена:</span>
                    <span class="configurator_page-price_span" id="price_conf"></span>
                    <span class="configurator_page-price_span_text_currency">руб.</span>
                </div>
            </div>
            <div class="container">
                <input class="configurator_page-price_input" type="number" name="price">
                <input class="configurator_page-build_name_input" value="{{ $conf }}" type="text" name="model_name">
                <input class="configurator_page-build_name_input" value="{{ 'Пользовательская конфигурация'.' '.rand(0,999999999) }}" type="text" name="package_name">
                @foreach($cases as $case)
                    @if($case -> ComputerModel -> name === $conf)
                        <input class="configurator_page-build_name_input" id="computer_case" type="text" name="corp_id" value="{{ $case -> id }}" data-price='{{ $case -> price }}'>
                    @endif
                @endforeach
            </div>
        </form>
    </main>
    <script src="{{ asset('script/blade-pattern/hover_btn-assemblies.js') }}">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script type="text/javascript">
        $('body').ready(function() {
            /*Проверка на количество планок ram*/
            let qty_ram = $('.motherboard').find(':selected').data('qtyram');
            let qty_conf = $('.motherboard').find(':selected').data('qtyramconf');
            for(let i = 1; i <= qty_ram; i++){
                if(i === qty_conf) {
                    $('#count_rams').append('<option selected value=' + i + '>' + i + '</option>');
                }
                else {
                    $('#count_rams').append('<option value=' + i + '>' + i + '</option>');
                }
            }
            /*Изменение кол-ва при изменении материнки*/
            $(".motherboard-select-select").change(function () {
                let qty_ram = $('.motherboard-select-select').find(':selected').data('qtyram');
                /*Очистка перед изменением*/
                $('#count_rams').empty();
                for (let i = 1; i <= qty_ram; i++) {
                    $('#count_rams').append('<option>' + i + '</option>');
                }
            });

            /*Проверка на совместимость материнок*/
            $('#cpuses').change(function () {
                if($('#cpuses').val() != null) {
                    $('#motherboard').removeAttr('id');
                    let id_socket = $(this).find('option:selected').data('socket');
                    let token = $("input[name='_token']").val();
                    /*Очистка перед изменением*/
                    $('#count_rams').empty();
                    /*Значение 0 до выбора материнки*/
                    $('#count_rams').append('<option selected disabled="disabled">' + 0 + '</option>');
                    console.log(id_socket);

                    $.ajax({
                        url: "{{ route('selectMotherboard', $model) }}",
                        method: 'POST',
                        data: {id_socket: id_socket, _token: token},
                        success: function (data) {
                            $(".motherboard").html('');
                            $(".motherboard").html(data.options);


                            let price = [];
                            /*Получение цены оперативной памяти в зависимости от выбранного select*/
                            let ram_price = $('#count_rams').find('option:selected').val() * ($('#rams').find('option:selected').data('price'));
                            price.push($('.cpu').find('option:selected').data('price'));
                            price.push(ram_price);
                            price.push($('#gpuses').find('option:selected').data('price'));
                            price.push(0);
                            price.push($('#psuses').find('option:selected').data('price'));
                            price.push($('#hdd').find('option:selected').data('price'));
                            price.push($('#ssd').find('option:selected').data('price'));
                            price.push($('#cooling').find('option:selected').data('price'));
                            price.push($('#computer_case').data('price'));

                            let total = 0;
                            for (let i = 0; i < price.length; i++) {
                                total += parseInt(price[i]);
                            }
                            console.log(price)

                            $('.configurator_page-price_span').html(total);
                            $('.configurator_page-price_input').val(total);
                        }
                    });
                }
            });

            /*Проверка на совместимость процессоров*/
            $("#motherboard").change(function () {
                if($('#motherboard').val() != null) {
                    $('#cpuses').removeAttr('id');
                    let id_socket = $(this).find('option:selected').data('socket');
                    let token = $("input[name='_token']").val();
                    console.log(id_socket);

                    $.ajax({
                        url: "{{ route('selectCpu', $model) }}",
                        method: 'POST',
                        data: {id_socket: id_socket, _token: token},
                        success: function (data) {
                            $(".cpu").html('');
                            $(".cpu").html(data.options);


                            let price = [];
                            /*Получение цены оперативной памяти в зависимости от выбранного select*/
                            let ram_price = $('#count_rams').find('option:selected').val() * ($('#rams').find('option:selected').data('price'));
                            price.push(0);
                            price.push(ram_price);
                            price.push($('#gpuses').find('option:selected').data('price'));
                            price.push($('.motherboard').find(':selected').data('price'));
                            price.push($('#psuses').find('option:selected').data('price'));
                            price.push($('#hdd').find('option:selected').data('price'));
                            price.push($('#ssd').find('option:selected').data('price'));
                            price.push($('#cooling').find('option:selected').data('price'));
                            price.push($('#computer_case').data('price'));

                            let total = 0;
                            for (let i = 0; i < price.length; i++) {
                                total += parseInt(price[i]);
                            }
                            console.log(price)

                            $('.configurator_page-price_span').html(total);
                            $('.configurator_page-price_input').val(total);
                        }
                    });
                }
            });

            /*Расчет динамической цены*/
            let price = [];
            /*Получение цены оперативной памяти в зависимости от выбранного select*/
            let ram_price = $('#count_rams').find('option:selected').val() * ($('#rams').find('option:selected').data('price'));
            price.push($('.cpu').find('option:selected').data('price'));
            price.push(ram_price);
            price.push($('#gpuses').find('option:selected').data('price'));
            price.push($('.motherboard').find(':selected').data('price'));
            price.push($('#psuses').find('option:selected').data('price'));
            price.push($('#hdd').find('option:selected').data('price'));
            price.push($('#ssd').find('option:selected').data('price'));
            price.push($('#cooling').find('option:selected').data('price'));
            price.push($('#computer_case').data('price'));

            console.log(price);

            let total = 0;
            for (let i = 0; i < price.length; i++) {
                total += parseInt(price[i]);
            }

            $('.configurator_page-price_span').html(total);
            $('.configurator_page-price_input').val(total);

            /*Получение изменения цены из блока*/
            $(".configurator_page-flex-block").change(function () {
                let price = [];
                /*Получение цены оперативной памяти в зависимости от выбранного select*/
                let ram_price = $('#count_rams').find('option:selected').val() * ($('#rams').find('option:selected').data('price'));
                price.push($('.cpu').find('option:selected').data('price'));
                price.push(ram_price);
                price.push($('#gpuses').find('option:selected').data('price'));
                price.push($('.motherboard').find(':selected').data('price'));
                price.push($('#psuses').find('option:selected').data('price'));
                price.push($('#hdd').find('option:selected').data('price'));
                price.push($('#ssd').find('option:selected').data('price'));
                price.push($('#cooling').find('option:selected').data('price'));
                price.push($('#computer_case').data('price'));

                let total = 0;
                for (let i = 0; i < price.length; i++) {
                    total += parseInt(price[i]);
                }

                /*Вывод с проверкой на Not As Number*/
                if (isNaN(total)) {
                    $('.configurator_page-price_span').html(0);
                    $('.configurator_page-price_input').val(0);
                }
                else{
                    $('.configurator_page-price_span').html(total);
                    $('.configurator_page-price_input').val(total);
                }
            });
            /*Получение изменения цены из блока*/
            $(".configurator_page-flex-block-2").change(function () {
                let price = [];
                /*Получение цены оперативной памяти в зависимости от выбранного select*/
                let ram_price = $('#count_rams').find('option:selected').val() * ($('#rams').find('option:selected').data('price'));
                price.push($('.cpu').find('option:selected').data('price'));
                price.push(ram_price);
                price.push($('#gpuses').find('option:selected').data('price'));
                price.push($('.motherboard').find(':selected').data('price'));
                price.push($('#psuses').find('option:selected').data('price'));
                price.push($('#hdd').find('option:selected').data('price'));
                price.push($('#ssd').find('option:selected').data('price'));
                price.push($('#cooling').find('option:selected').data('price'));
                price.push($('#computer_case').data('price'));

                console.log(price);

                let total = 0;
                for (let i = 0; i < price.length; i++) {
                    total += parseInt(price[i]);
                }

                /*Вывод с проверкой на Not As Number*/
                if (isNaN(total)) {
                    $('.configurator_page-price_span').html(0);
                    $('.configurator_page-price_input').val(0);
                }
                else{
                    $('.configurator_page-price_span').html(total);
                    $('.configurator_page-price_input').val(total);
                }
            });
            /*Получение изменения цены из блока*/
            $(".configurator_page-flex-block-3").change(function () {
                let price = [];
                /*Получение цены оперативной памяти в зависимости от выбранного select*/
                let ram_price = $('#count_rams').find('option:selected').val() * ($('#rams').find('option:selected').data('price'));
                price.push($('.cpu').find('option:selected').data('price'));
                price.push(ram_price);
                price.push($('#gpuses').find('option:selected').data('price'));
                price.push($('.motherboard').find(':selected').data('price'));
                price.push($('#psuses').find('option:selected').data('price'));
                price.push($('#hdd').find('option:selected').data('price'));
                price.push($('#ssd').find('option:selected').data('price'));
                price.push($('#cooling').find('option:selected').data('price'));
                price.push($('#computer_case').data('price'));

                let total = 0;
                for (let i = 0; i < price.length; i++) {
                    total += parseInt(price[i]);
                }

                /*Вывод с проверкой на Not As Number*/
                if (isNaN(total)) {
                    $('.configurator_page-price_span').html(0);
                    $('.configurator_page-price_input').val(0);
                }
                else{
                    $('.configurator_page-price_span').html(total);
                    $('.configurator_page-price_input').val(total);
                }
            });
        });
    </script>
@endsection
