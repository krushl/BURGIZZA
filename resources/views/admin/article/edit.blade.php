@extends('layouts.admin')
@section('title','add')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/profile.css') }}">
@endpush
@push('script-defer')
    <script src="https://cdn.tiny.cloud/1/25r8215szh46whopwon9lv34teb45rhdvkuwc99q2ptzhsl1/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endpush
@section('content')
    <div class="container-fluid bg-light">
        <div class="row p-3">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <form role="form" action="{{ route('admin.articles.edit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $article->id }}" name="articleId" />
                            <div class="form-group">
                                <label for="articleTitle">
                                    Название новости
                                </label>
                                <input type="text" name="articleTitle" value="{{ $article->title }}" class="form-control" id="articleTitle" />
                            </div>
                            <div class="form-group">
                            <textarea name="articleContent" >
                                {{$article->content}}
                            </textarea>
                            </div>
                            <div class="form-group ">
                                <br>
                                <label for="exampleInputFile">
                                    Обложка статьи
                                </label>
                                <input type="file" name="articleImage" class="form-control-file" id="exampleInputFile" />
                                <p class="help-block">

                                </p>
                            </div>
                            <br>
                            <input type="submit" class="btn btn-warning" value="Добавить">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        tinymce.init({
            selector: "textarea",
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks code fullscreen insertdatetime media nonbreaking',
                'table emoticons template paste help'
            ],
            toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                'forecolor backcolor emoticons | help',
            menu: {
                favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons'}
            },
            menubar: 'favs file edit view insert format tools table help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>
@endpush
