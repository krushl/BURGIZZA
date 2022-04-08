@extends('layouts.admin')

@section('title','adminka')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/admin.css') }}">
@endpush
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row d-flex justify-content-center">
                    <div class="admin-title col-md-3 d-flex flex-column justify-content-center align-items-center">
                        <a style="color:#111;" href="{{ route('admin.burger.burger-addForm') }}"><div class="admin-button burger-button">Бургеры</div> </a><br>
                    </div>
                    <div class="admin-title col-md-3 d-flex  flex-column justify-content-center align-items-center">
                        <a style="color:#111;" href="{{ route('admin.category.index') }}"><div class="admin-button category-button">Категории</div> </a><br>
                    </div>
                    <div class="admin-title col-md-3 d-flex flex-column  justify-content-center align-items-center">
                        <a style="color:#111;" href="{{ route('admin.status.index') }}"><div class="admin-button status-button">Статус</div> </a><br>
                    </div>
                    <div class="admin-title col-md-3 d-flex flex-column  justify-content-center align-items-center">
                        <a style="color:#111;" href="{{ route('admin.articles.index') }}"><div class="admin-button articles-button">Новости</div> </a><br>
                    </div>
                    <div class="admin-title col-md-3 d-flex flex-column  justify-content-center align-items-center">
                        <a style="color:#111;" href="{{ route('admin.ingredients.index') }}"><div class="admin-button articles-button">Ингредиенты</div> </a><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
