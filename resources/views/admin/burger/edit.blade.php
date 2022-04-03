@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Картинка</th>
            <th scope="col">Категория</th>
            <th scope="col">Состав</th>
            <th scope="col">Цена</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        @forelse($burgers as $burger)
        <tr>
            <th scope="row">{{ $burger->id }}</th>
            <td>{{$burger->name}}</td>
            <td>  <img src="{{asset('/storage/img/burgers/'.trim($burger->image->picture))}}" class="img-fluid img-thumbnail" alt="{{$burger->name}}"></td>
            <td>{{$burger->category->category}}</td>
            <td>{{$burger->beatifulyComposition(json_decode($burger->composition,JSON_UNESCAPED_UNICODE))  }}</td>
            <td>{{$burger->price}} ₽</td>
            <td>
                    <button class="btn btn-primary">&#9998;</button>
                    <button class="btn btn-danger delete" data-name="{{$burger->name}}" data-burgerId="{{ $burger->id }}" > &#128465;</button>
            </td>
        </tr>
        @empty
        <tr>
           <td  class="text-center" colspan="7">Нет данных </td>
        </tr>
        @endforelse
        </tbody>
    </table>

@push('script')
    <script>

        $(".delete").on('click',function(){
            if(confirm(`Вы действительно хотите удалить ${this.dataset.name}?`))
            {
                $.post({
                    url: "{{route('admin.burger.burger-destroy')}}",
                    data: {'_token': $('meta[name="csrf-token"]').attr('content'),'burgerId':this.dataset.burgerid  }
                    }).done(function (data) {
                    alert(data.message);
                    location.reload();
                });
            }
        })

    </script>
@endpush
