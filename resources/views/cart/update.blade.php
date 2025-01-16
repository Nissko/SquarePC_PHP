@if(count($CartList) > 0)
    <form action="{{ route('CardForm') }}" method="POST">
        @csrf
        <div class="cart-block-row1">
            <div class="cart-block-row1_product-title">
                Товар
            </div>
            <div class="cart-block-row1_price-title">
                Цена
            </div>
            <div class="cart-block-row1_count-title">
                Количество
            </div>
        </div>
        @foreach($CartList as $cart)
            @foreach($position as $pos)
                @if($pos -> package_name === $cart -> attributes -> package_name and $pos -> model_name === $cart -> name)
                    <div class="cart-block-row2">
                        <div class="del_assemblies del_assemblies-{{ $pos -> id }}" data-id="{{ $pos -> id }}" title="Удалить товар из корзины">✖</div>                            <div class="cart-block-row2_product-block">
                            {{ $cart ->name }} - {{ $cart -> attributes -> package_name }}
                            <details>
                                <summary>Подробнее</summary>
                                <div>
                                    {{ $pos -> cpuses -> name }}
                                </div>
                                <div>
                                    {{ $pos -> motherboardses -> name }}
                                </div>
                                <div>
                                    {{ $pos -> rams -> name }}x{{ $pos -> count_ram }}
                                </div>
                                <div>
                                    {{ $pos -> gpuses -> name }}
                                </div>
                                <div>
                                    {{ $pos -> psuses -> name }}
                                </div>
                                <div>
                                    {{ $pos -> disks -> name }}
                                </div>
                                <div>
                                    {{ $pos -> ssds -> name }}
                                </div>
                            </details>
                        </div>
                        <div class="cart-block-row2_price-block">
                            {{ $cart->price }} ₽
                        </div>
                        <div class="cart-block-row2_count-block">

                            <div class="number">
                                <button class="number-minus changeM_assemblies-{{ $pos -> id }}" data-id="{{ $pos -> id }}" type="button" onclick="this.nextElementSibling.stepDown();">-</button>
                                <input class="number-value-{{ $pos->id }}" type="number" min="1" max="{{ $cart -> attributes -> info_model -> count }}" value="{{ $cart -> quantity }}" required>
                                <button class="number-plus changeP_assemblies-{{ $pos -> id }}" data-id="{{ $pos -> id }}" type="button" onclick="this.previousElementSibling.stepUp();">+</button>
                            </div>

                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach
        <div class="row-3-cart">
            <button type="submit" class="buy_cart_btn">
                Заказать
            </button>

            <div class="total_sum_cart">
                <div class="total_cart">Итоговая сумма: <div class="total_sum_style">{{ $total }} ₽</div></div>
            </div>
        </div>
    </form>
@else
    <div class="container-md">
        <div>Список товаров пуст!</div>
    </div>
@endif

<script>
    $(document).ready(function () {
        for (let i = 0; i <= 999; i++){
            $('.del_assemblies-'+i).click(function (event) {
                let id = $('.del_assemblies-'+i).data('id');
                DeleteCart(id);
            });

            $('.changeM_assemblies-'+i).click(function () {
                let id = $('.changeM_assemblies-'+i).data('id');
                let qty = $('.number-value-'+i).val();
                UpdateCart(id, qty);
            });

            $('.changeP_assemblies-'+i).click(function () {
                let id = $('.changeP_assemblies-'+i).data('id');
                let qty = $('.number-value-'+i).val();
                UpdateCart(id, qty);
            });
        }
    })

    function DeleteCart(id){

        $.ajax({
            url: '{{ route('DeleteCart')}}',
            type: "POST",
            data: {
                id: id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                $(".cart-page-main").html(data.options);
            }
        });
    }
    function UpdateCart(id, qty){

        $.ajax({
            url: '{{ route('UpdateCart')}}',
            type: "POST",
            data: {
                id: id,
                qty: qty,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                $(".cart-page-main").html(data.options);
            }
        });
    }
</script>
