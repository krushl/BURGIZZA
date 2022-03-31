@extends('layouts.app')

@section('title','welcome')
@push('css')
    <link rel="stylesheet" href="{{asset('/asset/css/home.css')}}">
@endpush
@section('content')

    <div class="d-flex flex-column justify-content-center align-items-center home-container">
        <h2 class="home-title"> СЪЕШЬ МЕНЯ</h2>
        <a class="home-button" href="#">
            <span> Прямо сейчас</span>
            <div class="home-button-item" aria-hidden="true">
                <div class="home-button-item_inner" >
                    <span> Прямо сейчас</span>
                    <span> Прямо сейчас</span>
                    <span> Прямо сейчас</span>
                    <span> Прямо сейчас</span>
                </div>
            </div>
        </a>
    </div>
@endsection

