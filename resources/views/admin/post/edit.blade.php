@extends('layouts/app')

@section('stylesheets')
    <link href="{{asset('css/summer-note.css')}}" rel="stylesheet">
@endsection
@section('content')
    <ul class="list-group">
        @foreach($errors->all() as $error)
            <li class="list-group-item text-danger">
                {{$error}}
            </li>
        @endforeach
    </ul>
    <div class="card">
        <div class="card-header">
            تعديل المنشور
        </div>
        <div class="card-body">

            <form action="{{ @route('post.update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">العنوان</label>
                    <input class="form-control"  type="text" name="title" id="title" value="{{$post->title}}">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <label for="featured">الصورة</label>
                            <input class="form-control"  type="file" name="featured" id="featured">
                        </div>
                        <div class="col-4">
                            <img class="img-thumbnail" src="{{asset($post->featured)}}" alt="" height="50px">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category_id">الفئة</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" @if($category->id === $post->category->id) selected @endif >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="type_id">النوع</label>
                    <select name="type_id" id="type_id" class="form-control">
                        @foreach($types as $type)
                            <option value="{{$type->id}}" @if($type->id == $post->type->id) selected @endif>{{$type->type}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tags">الوسوم</label>
                    <select name="tags[]" id="tags" class="form-control" multiple>
                        @foreach($tags as $tag)
                            <option
                                    value="{{$tag->id}}"
                                    @foreach($post->tags as $t)
                                        @if($tag->id == $t->id) selected @endif
                                    @endforeach>
                                {{$tag->tag}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="published_at">تاريخ نشر البحث</label>
                    <input class="form-control" value="{{$post->published_at}}" readonly type="text" name="published_at" id="published_at">
                </div>

                <div class="form-group">
                    <label for="summary">ملخص</label>
                    <textarea class="form-control" name="summary" id="summary" rows="3">{{$post->summary}}</textarea>
                </div>
                <div class="form-group">
                    <label for="content">شرح البحث</label>
                    <textarea class="form-control" name="content" id="content" rows="20">{{$post->content}}</textarea>
                </div>
                <div class="form-group">
                    <label for="document"> ملف البحث</label>
                    <input class="form-control" type="file" name="document" id="document">
                    @if(isset($post->download_url))
                        <a class="btn btn-link" href="{{url($post->download_url)}}">
                            <i class="fa fa-download"></i>
                            <span>تحميل الملف السابق</span>
                        </a>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn btn-default">حفظ</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/summer-note.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#content').summernote();
            $('#tags').select2();

            $("#published_at").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
        })

    </script>
@endsection