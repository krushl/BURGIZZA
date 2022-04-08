@extends('layouts.app')

@section('title', 'menu')

@push('css')
    <link rel="stylesheet" href="{{asset('/asset/css/menu.css')}}">

@endpush

@section('content')
    <div class="container-fluid">
        <div class="row h-50 ">
            <div class=" menu-title">
                <h1 class="menu-title-item">
                    Меню
                </h1>
            </div>
        </div>
        <div class="text-center row">
            <div class="divider py-1 bg-secondary bg-gradient h-100 shadow-lg p-3 mb-5 bg-white rounded"><h2>Бургеры</h2></div>

        @forelse($burgers as $burger)
                    @include('menu.burgerCard', compact("burger"))
                @empty
                    <p class="text-center">Нету...</p>
                @endforelse
        </div>
    </div>
@endsection
