@extends('layouts.app')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title','index category')

@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/profile.css') }}">
@endpush

@section('content')
<p><a href="{{ route('admin.category.add') }}">Добавить категорию</a></p>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Категория</th>
        <th scope="col">Действие</th>
    </tr>
    </thead>
    <tbody>
    @forelse($categories as $category)
        <tr>
            <th scope="row">{{ $category->id }}</th>
            <td>{{$category->category}}</td>
            <td>
                <a class="btn btn-primary edit"  href = "{{route('admin.category.editForm',['category_id'=>$category->id])}}">&#9998;</a>
                <button class="btn btn-danger delete" data-category="{{$category->category}}" data-categoryId="{{ $category->id }}">
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
            if (confirm(`Вы действительно хотите удалить ${this.dataset.category}?`)) {
                $.post({
                    url: "{{route('admin.category.destroy')}}",
                    data: {'_token': $('meta[name="csrf-token"]').attr('content'), 'category_id': this.dataset.categoryId}
                }).done(function (data) {
                    alert(data.message);
                    location.reload();
                });
            }
        })
    </script>
@endpush


@endsection
