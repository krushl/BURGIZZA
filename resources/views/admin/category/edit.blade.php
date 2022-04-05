@extends('layouts.app')
@section('title','add edit')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/profile.css') }}">
@endpush

@section('content')
    <div class="container-fluid bg-light">
        <div class="row p-3">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5">
                        <form role="form" action="{{ route('admin.category.edit') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $category->id }}" name="category_id">
                            <div class="form-group">
                                <label for="category">
                                    Название категории
                                </label>
                                <input type="text" name="category" value="{{ $category->category }}" class="form-control" id="category" />
                            </div>
                            <br>
                            <input type="submit" class="btn btn-warning" value="Редактировать">
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
