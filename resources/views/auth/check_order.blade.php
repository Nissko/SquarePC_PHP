<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Товарный чек</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.min.css') }}"/>
    <script src="{{ asset('script/bootstrap/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{asset('css/css.css')}}">
    <link rel="stylesheet" href="{{asset('css/account_check_style.css')}}">
    <style>
        .flex-div{
            display: inline-block;
            float: right;
        }
        .font{
            font-family: "dejavu sans", sans-serif;
        }
        body {
            font-family: "dejavu sans", sans-serif !important;
            font-size: 13px;
            background: white;
        }
    </style>
</head>
<body class="user-select-none">
<div class="one">
    <div class="w-100">
        <div class="flex-div">
            <img src="{{ asset('img/barcode.png') }}" width="123">
        </div>
    </div>
    <div class="info-company">
        <div class="fs-3">Компания: ООО "SQUARE PC", ИНН 290982681603, КПП 504143520</div>
        <div class="fs-3">Адрес: Магнитогорск, пр Карла Маркса, 172</div>
    </div>
</div>

<div class="two">
    <div class="text-center fs-5 pt-4 pb-2">Заказ №{{ $orders -> id }} от {{ $orders -> created_at -> format('d.m.Y') }}</div>
    <div class="table-order">
        <table class="iksweb">
            <tbody>
            <tr>
                <td class="text-center fs-5">Товар</td>
                <td class="text-center fs-5">Цена</td>
                <td class="text-center fs-5">Кол-во</td>
                <td class="text-center fs-5">Сумма</td>
            </tr>
            @foreach($orders -> Positions as $order_item)
                <tr>
                    <td class="text-left tr_style">Компьютер: {{ $order_item -> model_name}} - {{ $order_item -> package_name }}</td>
                    <td class="text-center tr_style">{{ $order_item->price + 0 }} руб</td>
                    <td class="text-center tr_style">{{ $order_item->pivot->count_position }}</td>
                    <td class="text-center tr_style">{{ $order_item->price * $order_item->pivot->count_position }} руб</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="three">
    <div class="pt-3 pb-5">
        <span class="fs-4 total_info_order">Всего товаров {{ $count }}, на сумму {{ $orders -> price }} руб.</span>
    </div>
</div>

<div>
    <div style="vertical-align: middle;">
        Подпись продавца:
        <img src="{{ asset('img/print_order.png') }}" width="100">
    </div>
</div>

<div class="five">
    <div class="flex-div">
        М.П
        <img src="{{ asset('img/175.png') }} " alt="Печать" height="180">
    </div>
</div>
</body>
</html>
