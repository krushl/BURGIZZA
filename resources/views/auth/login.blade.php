@extends('layouts.app')
@section('title','auth')

@push('css')
    <link rel="stylesheet" href="{{ asset('/asset/css/style.css') }}">
@endpush
@section('content')
<section class="vh-100 bg-image" style="background:#111">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Войти</h2>

                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                @method('POST')
                                <div class="form-outline mb-4">
                                    <input type="text" name="login"  value="{{ old('login') }}" id="form3Example1cg" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example1cg">Логин</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" name="password" id="form3Example4cg" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example4cg">Пароль</label>
                                </div>

{{--                                <div class="form-check d-flex justify-content-center mb-5">--}}
{{--                                    <input--}}
{{--                                        class="form-check-input me-2"--}}
{{--                                        type="checkbox"--}}
{{--                                        value=""--}}
{{--                                        id="form2Example3cg"--}}
{{--                                    />--}}
{{--                                    <label class="form-check-label" for="form2Example3g">--}}
{{--                                        I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>--}}
{{--                                    </label>--}}
{{--                                </div>--}}

                                @error("errorLogin")
                                <p><small class="text-danger">{{ $message }}</small></p>
                                @enderror

                                <div class="d-flex justify-content-center">
                                    <input type="submit" class="btn btn-warning btn-block btn-lg gradient-custom-4 text-body" value="Войти">
                                </div>

{{--                                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="#!" class="fw-bold text-body"><u>Login here</u></a></p>--}}

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
