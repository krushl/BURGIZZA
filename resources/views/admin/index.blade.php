@extends('layouts.app')

@section('title','adminka')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/profile.css') }}">
@endpush
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-3 d-flex flex-column justify-content-center align-items-center">
                        <h2>Бургеры</h2>
                        <a style="color:#111;" href="{{ route('admin.burger.burger-addForm') }}"> Добавить бургеры</a><br>
                        <a style="color:#111;" href="{{ route('admin.burger.burger-editForm') }}"> Редактировать бургеры</a><br>
                    </div>
                    <div class="col-md-3 d-flex  flex-column justify-content-center align-items-center">
                        <h2>Категории</h2>
                        <a style="color:#111;" href="{{ route('admin.burger.burger-addForm') }}"> Добавить категорию</a><br>
                        <a style="color:#111;" href="{{ route('admin.burger.burger-addForm') }}"> Редактировать категории</a><br>
                    </div>
                    <div class="col-md-3 d-flex flex-column  justify-content-center align-items-center">
                        <h2>Статус</h2>
                        <a style="color:#111;" href="{{ route('admin.burger.burger-addForm') }}"> Просмотреть статусы</a><br>
                    </div>
                    <div class="col-md-3 d-flex flex-column  justify-content-center align-items-center">
                        <h2>Новости</h2>
                        <a style="color:#111;" href="{{ route('admin.burger.burger-addForm') }}"> Добавить новости</a><br>
                        <a style="color:#111;" href="{{ route('admin.burger.burger-addForm') }}"> Редактировать новости</a><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
