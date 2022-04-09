@extends('layouts.admin')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title','index ingredients')

@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/profile.css') }}">
@endpush

@section('content')
<p><a href="{{ route('admin.ingredients.add') }}">Добавить ингредиент</a></p>
<table class="table table-responsive">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Ингредиент</th>
        <th scope="col">Действие</th>
    </tr>
    </thead>
    <tbody>
    @forelse($ingredients as $ingredient)
        <tr>
            <th scope="row">{{ $ingredient->id }}</th>
            <td>{{$ingredient->ingredient}}</td>
            <td>
                <a class="btn btn-primary edit"  href = "{{route('admin.ingredients.editForm',['ingredient_id'=>$ingredient->id])}}">&#9998;</a>
                <button class="btn btn-danger delete" data-ingredients="{{$ingredient->ingredient}}" data-id="{{ $ingredient->id }}">
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
            if (confirm(`Вы действительно хотите удалить ${this.dataset.ingredients}?`)) {
                $.post({
                    url: "{{route('admin.ingredients.destroy')}}",
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
