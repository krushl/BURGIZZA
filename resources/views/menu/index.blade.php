@extends('layouts.app')

@section('title', 'menu')

@push('css')
    <link rel="stylesheet" href="{{asset('/asset/css/menu.css'}}">
@endpush

@section('content')
    <div class="container">
        <div class="container-fluid menu-title">
            <h1 class="menu-title-item">
                Меню
            </h1>
        </div>
        <div>
            <div class="row">
                @foreach($burgers as $burger)
                    @include('burger-card',compact("burger"))
                @endforeach
            </div>
        </div>
    </div>
@endsection
