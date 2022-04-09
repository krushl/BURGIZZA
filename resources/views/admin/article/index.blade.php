@extends('layouts.admin')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/profile.css') }}">
@endpush

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <h1 class="text-center">Новости</h1>
    <p class="px-sm-4 py-sm-4"><a href="{{route('admin.articles.addForm')}}">Добавить статью</a></p>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 px-sm-4">
        @forelse($articles as $article)
            <div class="col">
                <div class="card shadow-sm">
                    <div class="d-flex col-12  card-header">
                        <div class="col-10"><h3>{{$article->title}}</h3></div>
                        <div class="col-2 btn-group">
                            <a class="btn btn-primary edit"
                               href="{{route('admin.articles.editForm',['articleId'=>$article->id])}}">&#9998;</a>
                            <button class="btn btn-danger delete" data-name="{{$article->title}}"
                                    data-articleId="{{ $article->id }}">
                                &#128465;
                            </button>
                        </div>
                    </div>
                    <img src="{{asset('/storage/img/articles/'.trim($article->image))}}" height="250" width="200"
                         class="bd-placeholder-img card-img-top" alt="{{$article->title}}"/>
                    <div class="card-body">
                        <p class="card-text">{!!$article->content!!}</p>
                        <div class="d-flex justify-content-between align-items-center">

                            <small class="text-muted">{{$article->date}}</small>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center"> Статей нет</div>
        @endforelse
    </div>
@endsection
@push('script')
    <script>

        $(".delete").on('click', function () {
            if (confirm(`Вы действительно хотите удалить ${this.dataset.name}?`)) {
                $.post({
                    url: "{{route('admin.articles.destroy')}}",
                    data: {'_token': $('meta[name="csrf-token"]').attr('content'), 'articleId': this.dataset.articleid}
                }).done(function (data) {
                    alert(data.message);
                    location.reload();
                });
            }
        })


    </script>
@endpush
