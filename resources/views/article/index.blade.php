@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/profile.css') }}">
@endpush

@section('content')
    <h1 class="text-center">Новости</h1>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 px-sm-4">
        @forelse($articles as $article)
            <div class="col">
                <div class="card shadow-sm">
                    <div class="d-flex col-12  card-header">
                        <div class="col-10"><h3>{{$article->title}}</h3></div>
                    </div>
                    <img src="{{asset('/storage/img/articles/'.trim($article->image))}}" height="250" width="200"
                         class="bd-placeholder-img card-img-top" alt="{{$article->title}}"/>
                    <div class="card-body">
                        <p class="card-text">{!!mb_substr($article->content,0,170)."..."!!}</p>
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
