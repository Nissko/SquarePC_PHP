<link rel="stylesheet" href="{{asset('css/account-style_orders.css')}}">

<div class="user-order-div">
    @foreach($orders as $order)
        <div class="account-page-right_menu-show_orders_block">
            <div class="order-name">Заказ {{ $order -> name }} #{{ $order -> id }}</div>
            <div class="order-status">Статус: {{ $order -> status }}</div>
            <div class="order-price">Стоимость заказа: {{ $order -> price }} ₽</div>
            <form action="{{ route('downloadPDF', $order -> id) }}" method="get" title="Получить чек заказа">
                <button type="submit" class="order_check">Квитанция заказа</button>
            </form>
            <details>
                <summary>Подробнее о заказе</summary>
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
    @endforeach
</div>
