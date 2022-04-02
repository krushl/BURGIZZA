@extends('layouts.app')

@section('title','edit borgir')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/profile.css') }}">
@endpush
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Картинка</th>
            <th scope="col">Категория</th>
            <th scope="col">Состав</th>
            <th scope="col">Цена</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($burgers as $burger)
        <tr>
            <th scope="row">1</th>
            <td>{{$burger->name}}</td>
            <td>  <img src="{{asset('/img/burgers/'.$burger->image->picture)}}" class="img-fluid img-thumbnail" alt="{{$burger->name}}"></td>
            <td>{{$burger->category->category}}</td>
            <td>{{ \App\Helper\MenuHelper::beatifulyComposition(json_decode($burger->composition,JSON_UNESCAPED_UNICODE))  }}</td>
            <td>{{$burger->price}} ₽</td>
            <td>
                <form>
                <button class="btn btn-primary">&#9998;</button>
                <button class="btn btn-danger" id="delete"> &#128465;</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

@endsection

@push('script')
    <script>
        document.getElementById('delete').addEventListener('click', function(){
            confirm('Вы действительно хотите удалить БИГКИНГ?');
        })
    </script>
@endpush
