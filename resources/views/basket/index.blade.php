@extends('layouts.app')

@section('title','basket')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/profile.css') }}">
@endpush

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <form method="post">
        <table class="table table-responsive">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Картинка</th>
                <th scope="col">Количество</th>
                <th scope="col">Цена</th>
                <th scope="col">Итого</th>
            </tr>
            </thead>
            <tbody>
            @forelse($orderBurgers as $order)
                <tr>
                    <th scope="row">{{ $order->order->id }}</th>
                    <td>{{$order->burger->name}}</td>
                    <td><img src="{{asset('/storage/img/burgers/'.trim($order->burger->image))}}"
                             class="img-thumbnail" alt="{{$order->burger->name}}" width="200" height="300"></td>
                    <td>
                        <button name="minus" class="number-minus" type="button"
                                onclick="this.nextElementSibling.stepDown(); this.nextElementSibling.onchange();">
                            -
                        </button>
                        <input type="number" min="0" name="quantity" class="quantity" value="{{$order->count}}"
                               readonly>
                        <button class="number-plus" type="button"
                                onclick="this.previousElementSibling.stepUp(); this.previousElementSibling.onchange();">
                            +
                        </button>
                    </td>
                    <td class="priceK">{{$order->burger->price}} ₽</td>
                    <td class="total-price">0 ₽</td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="7">Нет данных</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="">Итого к оплате: <br><br>
            <div id="order_cost"></div>
        </div>
        </div>

    </form>
@endsection
@push('script')
    <script>

        {{--$(".delete").on('click', function () {--}}
        {{--    if (confirm(`Вы действительно хотите удалить ${this.dataset.name}?`)) {--}}
        {{--        $.post({--}}
        {{--            url: "{{route('basketDestroy')}}",--}}
        {{--            data: {'_token': $('meta[name="csrf-token"]').attr('content'), 'burgerId': this.dataset.burgerid}--}}
        {{--        }).done(function (data) {--}}
        {{--            alert(data.message);--}}
        {{--            location.reload();--}}
        {{--        });--}}
        {{--    }--}}
        {{--})--}}
        $(document).ready(function () {
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

            var sum = 0;
            $('.quantity').change(function () {
                var $tr = $(this).closest('tr'),
                    $total = $tr.find('.total-price'),
                    total = parseInt($tr.find('.priceK').text()) * +this.value || 0;
                sum = sum - (parseInt($total.text()) || 0) + total;
                $total.text(total + '₽');
                $('#order_cost').html("<input type='number' class='t' readonly name='order_cost' value='" + sum + "'>");
            }).change();
        });

    </script>
@endpush
