@extends('layouts.admin')
@section('title','edit ingredients')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/profile.css') }}">
@endpush

@section('content')
    <div class="container-fluid bg-light">
        <div class="row p-3">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5">
                        <form role="form" action="{{ route('admin.ingredients.edit') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $ingredients->id }}" name="ingredients_id">
                            <div class="form-group">
                                <label for="ingredients">
                                    Редактировать статус
                                </label>
                                <input type="text" name="ingredient" value="{{ $ingredients->ingredient }}" class="form-control" id="ingredients" />
                            </div>
                            <br>
                            <input type="submit" class="btn btn-warning" value="Редактировать">
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
