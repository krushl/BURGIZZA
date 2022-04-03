@extends('layouts.app')

@section('title', 'menu')

@push('css')
    <link rel="stylesheet" href="{{asset('/asset/css/menu.css')}}">

@endpush

@section('content')

        <div class="container-fluid menu-title">
            <h1 class="menu-title-item">
                Меню
            </h1>
        </div>
        <div>
            <div class="row">
                @forelse($burgers as $burger)
                    @include('menu.burgerCard',compact("burger"))
                @empty
                    <p class="text-center">Нету...</p>
                @endforelse
            </div>
        </div>

@endsection
