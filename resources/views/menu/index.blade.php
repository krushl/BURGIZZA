@extends('layouts.app')

@section('title', 'menu')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('/asset/css/menu.css')}}">

@endpush

@section('content')
    <div class="container-fluid min-vh-100 bg">

        <div class="row h-50 ">
            <div class=" menu-title">
                <h1 class="menu-title-item">
                    Меню
                </h1>
            </div>
        </div>
        <div class="text-center">
            <div class="divider py-1 bg-secondary bg-gradient h-100 shadow-lg p-3 mb-5 bg-dark text-white rounded"><h2>Бургеры</h2></div>
        </div>
            <div class="row d-flex justify-content-center">
        @forelse($burgers as $burger)
                    @include('menu.burgerCard', compact("burger"))
                @empty
                    <p class="text-center">Нету...</p>
                @endforelse
            <div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content  bg-secondary bg-gradient bg-dark">
                        <div class="modal-header ">
                            <h5 class="modal-title text-white" id="exampleModalLongTitle">777</h5>
                            <button type="button" class="close btn btn-warning" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body bg-white">
                            <div class="row">
                                <div class="col-md-8 px-2 py-2">
                                    <div>
                                    <p>Состав:</p>
                                    <ul class="modal-composition">

                                    </ul>
                                    </div>
                                    <form method="post" action="{{ route('basketAdd') }}">
                                        @csrf
                                    <div class="px-2 py-2">
                                            <hr>
{{--                                            <h3>Особые пожелания:</h3>--}}
{{--                                            <div class="modal-special_requests"></div>--}}
{{--
{{--                                            <hr>--}}
                                        <div class="modal-burgerId"></div>
                                    </div>
                                    <h3 class="modal-price">

                                    </h3>
                                </div>

                                <div class="col-md-4 ">
                                    <img src="" class="modal-img" height="200" width="300"/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-secondary bg-gradient bg-dark">
                            <div class="d-flex flexrow px-2 ">
                               <button type="button" class="btn btn-outline-warning minus m-2" onclick="this.nextElementSibling.stepDown(); this.nextElementSibling.onchange();">-</button>
                                        <input type="number" class="form-control count w-25"  min="0" name="count"  value="1"  readonly />
                                     <button type="button" class="btn btn-outline-warning plus m-2" onclick="this.previousElementSibling.stepUp(); this.previousElementSibling.onchange();">+</button>
                            </div>
                            <input type="submit" class="btn btn-warning addToBasket" value="Купить">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>

        </div>






@endsection

@push('script')
    <script type="text/javascript" src="{{asset('/asset/js/vanilla-tilt.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script type="text/javascript">
        VanillaTilt.init(document.querySelectorAll('.box'),
            {
                max:25,
                speed:400
            });
        $('.buy').click(function () {
            showModal(JSON.parse(this.dataset.burger));
            $('#myModal').modal('show')
        });

        $('.about').click(function () {
            showModal(JSON.parse(this.dataset.burger));
            $('#myModal').modal('show')
        });

        $('.close').click(function () {
            $('#myModal').modal('hide');
        });


        function showModal(burger) {
            $('#exampleModalLongTitle').text(burger.name);

            str = '';
            // requests = '';
            for ( const [key,val] of Object.entries(JSON.parse(burger.composition)))
            {
                str += `<li>${val}</li>`
                // requests += `<label for="composition[${key}]"> Без ${val} </label>
                //             <input type="checkbox" name="composition[${key}]" value=${burger.composition} id="composition[${key}]"/>`
            }

            $('.modal-composition').html(str);
            $('.modal-price').html('Цена: ' + burger.price + '₽');


            // $('.modal-special_requests').html(requests)
            $('.modal-burgerId').html(`<input type=hidden name="burgerId" value="${burger.id}" />`)

            $('.modal-img').attr('src',"{{asset('/storage/img/burgers')}}" + '/'+ burger.image);
        }

        $(document).ready(function () {
            $('.plus').click(function (e) {
                e.preventDefault();
                $(this).siblings('.count').val(function (i, val) {
                    return +val || 0;
                }).change();
            });
            $(".minus").click(function (e) {
                e.preventDefault();
                $(this).siblings('.count').val(function (i, val) {
                    return +val || 0;
                }).change();
            });
        });



    </script>
@endpush
