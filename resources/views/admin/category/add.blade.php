@extends('layouts.admin')
@section('title','add category')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/profile.css') }}">
@endpush

@section('content')
    <div class="container-fluid bg-light">
        <div class="row p-3">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5">
                        <form role="form" action="{{ route('admin.category.add') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="category">
                                    Название категории
                                </label>
                                <input type="text" name="category" value="{{ old('category') }}" class="form-control" id="category" />
                            </div>
                            <br>
                            <input type="submit" class="btn btn-warning" value="Добавить">
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
