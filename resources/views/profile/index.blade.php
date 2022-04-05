@extends('layouts.app')
@section('title','profile')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/profile.css') }}">
@endpush
@section('content')
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
                            <ul class="list-group list-group-flush ">
                                <li class="list-group-item">
                                     Логин: {{Auth::user()->login}}
                                </li>
                                <li class="list-group-item">
                                     Имя: {{Auth::user()->name}}
                                </li>
                                <li class="list-group-item">
                                     Email: {{Auth::user()->email}}
                                </li>
                                <li class="list-group-item">
                                     Роль: {{Auth::user()->roles[0]->role}}
                                </li>
                                @if(Gate::allows('admin'))
                                    <li class="list-group-item">
                                        <a href="{{ route('admin.index') }}">Admin panel</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="col-md-7">
                            <form role="form" method="POST" action="{{ route('changeOptional') }}">
                                @csrf
                                <div class="form-group">

                                    <label for="exampleInputName">
                                        Имя
                                    </label>
                                    <input type="text" name='userName' class="form-control" id="exampleInputName" />
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        Почта
                                    </label>
                                    <input type="email" name="userEmail" class="form-control" id="exampleInputEmail1" />
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label for="exampleInputPassword1">--}}
{{--                                        Password--}}
{{--                                    </label>--}}
{{--                                    <input type="password" class="form-control" id="exampleInputPassword1" />--}}
{{--                                </div>--}}
                                @error('errorProfile')
                                <p><small class="text-danger">{{ $message }}</small></p>
                                @enderror
                                <br>
                                <input type="submit" class="btn btn-primary" value="Обновить информацию">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
