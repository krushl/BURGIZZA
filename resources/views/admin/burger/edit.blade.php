
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
{{--            <td>  <img src="{{HTML::image('/storage/app/public/img/burgers/'.$burger->image->picture)}}" class="img-fluid img-thumbnail" alt="{{$burger->name}}"></td>--}}
            <td>  <img src="{{asset('/asset/img/burgers/'.trim($burger->image->picture))}}" class="img-fluid img-thumbnail" alt="{{$burger->name}}"></td>
            <td>{{$burger->category->category}}</td>
            <td>{{ \App\Helper\MenuHelper::beatifulyComposition(json_decode($burger->composition,JSON_UNESCAPED_UNICODE))  }}</td>
            <td>{{$burger->price}} ₽</td>
            <td>
                <form>
                <button class="btn btn-primary">&#9998;</button>
                <button class="btn btn-danger" id="delete"> &#128465;</button>
                </form>
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
        document.getElementById('delete').addEventListener('click', function(){
            confirm('Вы действительно хотите удалить БИГКИНГ?');
        })
    </script>
@endpush
