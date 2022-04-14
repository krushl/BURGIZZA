@extends('layouts.admin')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title','adminka')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/admin.css') }}">
@endpush
@section('content')

    <div class="container">
        <div class="table-responsive-sm">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th>#Номер заказа</th>
                    <th>Дата заказа</th>
                    <th>Пользователь</th>
                    <th scope="col">Название / Количество</th>
                    <th scope="col">Итого</th>
                    <th scope="col">Статус заказа</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>
                            {{$order->id}}
                        </td>
                        <td>
                            {{(new DateTime($order->date))->format('d:m:Y')}}
                        </td>
                        <td>
                            {{$order->name}}
                        </td>
                        <td>
                            @foreach($order->burgers as $burger)
                                <p>{{$burger->burger->name.' : '.$burger->count}}</p>
                            @endforeach
                        </td>
                        <td>
                            {{$order->final_price}} ₽
                        </td>
                        <td>
                            <select name="orderStatus" id="orderStatus" data-orderId="{{$order->id}}" class="orderStatus form-select">
                                @forelse($statuses as $status)
                                    <option value="{{$status->id}}" {{$status->id == $order->status->id? 'selected' : ''}} class="form-control-item"> {{ $status->status }}</option>
                                @empty
                                    <option value="-1" class="form-control-item">error?</option>
                                @endforelse
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="4">Нет данных</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('script')
    <script>
            $('.orderStatus').change(function () {
                let statusId = $(this).val();
                console.log(statusId);
                $.post({
                    url: "{{route('admin.orders.change')}}",
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'statusId': statusId,
                        'orderId': this.dataset.orderid
                    }
                }).done(function (data) {
                    alert(data.message);
                    location.reload();
                });
            });
    </script>
@endpush
