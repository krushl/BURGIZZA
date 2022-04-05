@extends('layouts.app')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title','index status')

@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/profile.css') }}">
@endpush

@section('content')
<p><a href="{{ route('admin.status.add') }}">Добавить статус</a></p>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Статус</th>
        <th scope="col">Действие</th>
    </tr>
    </thead>
    <tbody>
    @forelse($statuses as $status)
        <tr>
            <th scope="row">{{ $status->id }}</th>
            <td>{{$status->status}}</td>
            <td>
                <a class="btn btn-primary edit"  href = "{{route('admin.status.editForm',['status_id'=>$status->id])}}">&#9998;</a>
                <button class="btn btn-danger delete" data-status="{{$status->status}}" data-id="{{ $status->id }}">
                    &#128465;
                </button>
            </td>
        </tr>
    @empty
        <tr>
            <td class="text-center" colspan="3">Нет данных</td>
        </tr>
    @endforelse
    </tbody>
</table>

@push('script')
    <script>
        $(".delete").on('click', function () {
            if (confirm(`Вы действительно хотите удалить ${this.dataset.status}?`)) {
                $.post({
                    url: "{{route('admin.status.destroy')}}",
                    data: {'_token': $('meta[name="csrf-token"]').attr('content'), 'id': this.dataset.id}
                }).done(function (data) {
                    alert(data.message);
                    location.reload();
                });
            }
        })
    </script>
@endpush


@endsection
