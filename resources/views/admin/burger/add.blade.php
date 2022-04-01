@extends('layouts.app')
@section('title','add borgir')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/profile.css') }}">
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-5">
                    <form role="form" action="{{ route('admin.burger-add') }}" method="POST">
                        @csrf
                        <div class="form-group">

                            <label for="burgerName">
                                 Название бургера
                            </label>
                            <input type="text" name="burgerName" class="form-control" id="burgerName" />
                        </div>
                        <div class="form-group">

                            <label for="price">
                                Цена
                            </label>
                            <input type="text" name="price" class="form-control" id="price" />
                        </div>

                        <div class="form-group">

                            <label for="Composition">
                                Состав
                            </label>
                            <label for="CompositionItem">
                                Добавить ?
                            </label>
                            <input type="text" name="addCompot" id="addCompot"/>
                            <button type="button" name="price" class="form-control" id="plus">+</button>
                            <button type="button" name="price" class="form-control" id="minus">-</button>
                            <div id="containerComposition" class="form-group">

                            </div>
                        </div>
                        <div class="form-group">

                            <label for="exampleInputFile">
                                File input
                            </label>
                            <input type="file" name="burgerPic" class="form-control-file" id="exampleInputFile" />
                            <p class="help-block">

                            </p>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </form>
                </div>
                <div class="col-md-7">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        let plus = document.getElementById('plus'),
            minus = document.getElementById('minus'),
            addCompot = document.getElementById('addCompot'),
            container = document.getElementById('containerComposition');

        function createInput(value){
            let input = document.createElement('input');
            input.type = 'text';
            input.name = `composition[${value}]`;
            input.classList.add('form-control');
            container.append(input);
        }

        plus.addEventListener('click',function(){
                if (addCompot.value) {
                    createInput(addCompot.value);
                }
        });
    </script>
@endpush
