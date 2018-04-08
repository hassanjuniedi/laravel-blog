@extends('layouts/app')

@section('stylesheets')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
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
            Create New Post
        </div>
        <div class="card-body">

            <form action="{{ @route('post.update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control"  type="text" name="title" id="title" value="{{$post->title}}">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <label for="featured">Featured Image</label>
                            <input class="form-control"  type="file" name="featured" id="featured">
                        </div>
                        <div class="col-4">
                            <img class="img-thumbnail" src="{{asset($post->featured)}}" alt="" height="50px">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" @if($category->id === $post->category->id) selected @endif >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tags">Tags</label>
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
                    <label for="content"></label>
                    <textarea class="form-control" name="content" id="content" rows="5">{{$post->content}}</textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script>
        $(document).ready(function () {
            $('#content').summernote();
        })
    </script>
@endsection