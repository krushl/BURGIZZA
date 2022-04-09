<div class="col-sm-6 col-md-4 container-box">
    <div class="box">
        <img class="burger" src="{{asset('/storage/img/burgers/'.trim($burger->image))}}" alt="{{$burger->name}}">
        <div class="caption">
            <h3 class="name">{{$burger->name}}</h3>
            <p class="price">{{$burger->price}} ₽</p>
            <p>
                <button type="button" class="btn btn-warning buy" data-toggle="modal" data-burger="{{$burger}}" data-bs-target="trigger"  role="button">Добавить в корзину</button>
                <button type="button" class="btn btn-outline-warning about" data-burger="{{$burger}}" data-toggle="modal" data-target="#exampleModalCenter" role="button">Подробнее</button>
            </p>
        </div>
    </div>
</div>

