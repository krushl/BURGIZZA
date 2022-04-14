@extends('layouts.app')

@section('title','basket')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/basket.css') }}">
@endpush

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

        <div class="table-responsive-sm">
            <form method="post" action="{{""}}">
                @csrf

        <table class="table table-sm">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Название</th>
                <th scope="col">Картинка</th>
                <th scope="col">Цена</th>
                <th scope="col">Итого</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($orderBurgers as $order)
                <tr>
                    <th scope="row" width="1%">
                        <button name="minus" class="btn btn-warning minus m-2 number-minus" type="button"
                                            onclick="this.nextElementSibling.stepDown(); this.nextElementSibling.onchange();">
                            -
                        </button>
                        <input type="number" min="0" name="quantity" class="form-control count quantity" value="{{$order->count}}"
                               readonly>
                        <button class="btn btn-warning minus m-2 number-plus" type="button"
                                onclick="this.previousElementSibling.stepUp(); this.previousElementSibling.onchange();">
                            +
                        </button></th>
                    <td>{{$order->burger->name}}</td>
                    <td><img src="{{asset('/storage/img/burgers/'.trim($order->burger->image))}}"
                             class="img-thumbnail" alt="{{$order->burger->name}}" width="200" height="300"></td>
                    <td class="priceK">{{$order->burger->price}} ₽</td>
                    <td class="total-price">0 ₽</td>
                    <td class=""><button type='button' class="btn btn-danger delete" data-name="{{$order->burger->name}}" data-burgerId="{{ $order->burger->id }}">
                            &#128465;
                        </button></td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="7">Нет данных</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="container min-vw-100">
            <div class="row ">
                <div class="col-9">
                    <Br>
                    <label for="userName"> Имя: </label>
                    <input type="text" name="userName" id="userName" required class="userName form-control w-50"/>
                    <br>
                    <label for="userAddress"> Адресс: </label>
                    <input type="text" name="userAddress" id="userAddress" required class="userAddress form-control w-50"/>
                    <br>
                    <label for="userPhone"> Телефон: </label>
                    <input type="number" name="userPhone" id="userPhone" required class="userPhone form-control w-50"/>
                    <br>
                    <div>
                        <button type="submit" class="makeOrder btn btn-warning" data-orderId="{{session('orderId')}}" > Оформить заказ</button>
                    </div>
                </div>
                <div class="col-3 total-cost ">Итого к оплате: <br><br>
                    <div id="order_cost"></div>

                </div>
            </div>
        </div>



    </form>
</div>
@endsection
@push('script')
    <script>

        $(".delete").on('click', function () {
            if (confirm(`Вы действительно хотите удалить ${this.dataset.name}?`)) {
                $.post({
                    url: "{{route("basketDestroy")}}",
                    data: {'_token': $('meta[name="csrf-token"]').attr('content'), 'burgerId': this.dataset.burgerid}
                }).done(function (data) {
                    alert(data.message);
                    location.reload();
                });
            }
        })
        $(document).ready(function () {
            //
            // $('#userAddress').on('input change',function (){
            //     if($('#userAddress').val() !== ''){
            //         $('.makeOrder').attr('disabled',false);
            //     } else {
            //         $('.makeOrder').attr('disabled',true);
            //     }
            // })
            //
            // $('#userPhone').on('input change',function (){
            //     if($('#userPhone').val() !== ''){
            //         $('.makeOrder').attr('disabled',false);
            //     } else {
            //         $('.makeOrder').attr('disabled',true);
            //     }
            // })
            //
            //
            // $('#userName').on('input change',function (){
            //     if($('#userName').val() !== ''){
            //         $('.makeOrder').attr('disabled',false);
            //     } else {
            //         $('.makeOrder').attr('disabled',true);
            //     }
            // })


            $('.number-plus').click(function (e) {
                e.preventDefault();
                $(this).siblings('.quantity').val(function (i, val) {
                    return +val || 0;
                }).change();
            });
            $(".number-minus").click(function (e) {
                e.preventDefault();
                $(this).siblings('.quantity').val(function (i, val) {
                    return +val || 0;
                }).change();
            });

            let sum = 0;
            $('.quantity').change(function () {
                let $tr = $(this).closest('tr'),
                    $total = $tr.find('.total-price'),
                    total = parseInt($tr.find('.priceK').text()) * +this.value || 0;
                sum = sum - (parseInt($total.text()) || 0) + total;
                $total.text(total + '₽');
                $('#order_cost').html("<input type='number' class='t' id='finalPrice' readonly name='order_cost' value='" + sum + "'> ₽");
            }).change();
        });

        $('.makeOrder').on('click',function(e){
            e.preventDefault();
            if( $('#userName').val() !=='' && $('#userAddress').val() !=='' && $('#userPhone').val() !=='') {

                let finalPrice = $('#finalPrice').val();
                let userName = $('#userName').val();
                let userAddress = $('#userAddress').val();
                let userPhone = $('#userPhone').val();
                let user = {
                    name: userName,
                    address: userAddress,
                    phone: userPhone,
                }
                $.post({
                    url: "{{route('makeOrder')}}",
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'orderId': this.dataset.orderid,
                        'finalPrice': finalPrice,
                        'user': user
                    }
                }).done(function (data) {
                    alert(data.message);
                    location.reload();
                });
            }
        });

    </script>
@endpush
