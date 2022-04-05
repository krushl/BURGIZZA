@extends('layouts.app')
@section('title','edit status')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/profile.css') }}">
@endpush

@section('content')
    <div class="container-fluid bg-light">
        <div class="row p-3">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5">
                        <form role="form" action="{{ route('admin.status.edit') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $status->id }}" name="status_id">
                            <div class="form-group">
                                <label for="status">
                                    Редактировать статус
                                </label>
                                <input type="text" name="status" value="{{ $status->status }}" class="form-control" id="status" />
                            </div>
                            <br>
                            <input type="submit" class="btn btn-warning" value="Редактировать">
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
