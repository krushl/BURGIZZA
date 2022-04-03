@extends('layouts.app')
@section('title','add borgir')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/profile.css') }}">
@endpush

@section('content')
<div class="container-fluid bg-light">
    <div class="row p-3">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-5">
                    <form role="form" action="{{ route('admin.burger.burger-add') }}" method="POST" enctype="multipart/form-data">
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
                            <labeL for="category">
                                Тип
                            </labeL>
                            <select class="form-select" id="category" name="category">
                                <option value="0" class="form-control-item" selected> Выберите тип мяса</option>
                                <option value="1" class="form-control-item"> Из говядины</option>
                                <option value="2" class="form-control-item">Из курицы</option>
                                <option value="3" class="form-control-item">Из рыбы</option>
                            </select>
                        </div>
                        <br>
                        <div class="form-group">

                            <label for="Composition">
                                Состав
                            </label> <br>
                            <label for="CompositionItem">
                                Добавить компонент
                            </label>

                            <input type="text" class="form-control" name="addCompot" id="addCompot"/>
                            <br>
                            <div class="d-flex flex-row">
                            <button type="button" name="price" class="form-control" id="plus">+</button>
                            <br>
                            <button type="button" name="price" class="form-control" id="minus">-</button>
                            <br>
                            </div>
                            <div id="containerComposition" class="form-group">

                            </div>
                        </div>
                        <div class="form-group ">
                            <br>
                            <label for="exampleInputFile">
                                Фотка бургера
                            </label>
                            <input type="file" name="burgerPic" class="form-control-file" id="exampleInputFile" />
                            <p class="help-block">

                            </p>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-warning" value="Добавить">
                    </form>
                </div>
                <div class="col-md-7">
                    @include('admin.burger.edit',compact('burgers'))
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
            let div = document.createElement('div');
            let p = document.createElement('p');
            p.textContent = value;
            div.append(p);
            input.type = 'text';
            input.name = `composition[${value}]`;
            input.classList.add('form-control');
            input.classList.add('m-2');
            div.append(input);
            container.append(div);
        }

        plus.addEventListener('click',function(){
                if (addCompot.value) {
                    createInput(addCompot.value);
                }
        });
        minus.addEventListener('click',function(){
            console.log(container.lastChild.remove());
        });
    </script>
@endpush
