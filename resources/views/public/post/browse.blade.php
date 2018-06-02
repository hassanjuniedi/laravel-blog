@extends('layouts.public')
@section('css')
    <link rel="stylesheet" href="{{asset('css/navbar-black.css')}}">
@endsection
@section('content')
    <br><br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>منشورات المجلة</h2>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-3">
                <form method="get">
                    <h6>الفئة: </h6>
                    <div class="">
                        <div class="form-group mb-0">
                            <label for="category">
                                <input type="radio" name="category"  value="" checked >
                                الكل
                            </label>
                        </div>
                        @foreach($categories as $category)
                            <div class="form-group mb-0">
                                <label for="category">
                                    <input type="radio" name="category"  value="{{$category->id}}" @if($query['category'] == $category->id ) checked="checked" @endif>
                                    {{$category->name}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <h6>نوع المنشور: </h6>
                    <div class="">
                        <div class="form-group mb-0">
                            <label for="type">
                                <input type="radio" name="type" value="" checked>
                                الكل
                            </label>
                        </div>
                        @foreach($types as $type)
                            <div class="form-group mb-0">
                                <label for="type">
                                    <input type="radio" name="type" value="{{$type->id}}" @if($query['type'] == $type->id ) checked="checked" @endif>
                                    {{$type->type}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <h6>سنة النشر: </h6>
                    <div class="">
                        <div class="form-group mb-0">
                            <label for="year">
                                <input type="radio" name="year" value="" checked>
                                الكل
                            </label>
                        </div>
                        @foreach($years as $year)
                            <div class="form-group mb-0">
                                <label for="year">
                                    <input type="radio" name="year" value="{{$year}}" @if($query['year'] == $year ) checked="" @endif>
                                    {{$year}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <h6>الوسوم: </h6>
                    <div class="">
                        @foreach($tags as $tag)
                            <div class="form-group mb-0">
                                <label for="tag[]">
                                    <input type="checkbox" name="tag[]" value="{{$tag->id}}" @if(isset($query['tags']) && in_array($tag->id, $query['tags']) ) checked="" @endif>
                                    {{$tag->tag}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">
                            <i class="fa fa-filter" aria-hidden="true"></i>
                            <span>فلترة النتائج</span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-lg-4">
                            <div class="card d-inline-block mb-2">
                                <img src="{{$post->featured}}" class="img-fluid" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="{{ route('public.post.show',['id'=> $post->id]) }}">{{$post->title}}</a>
                                    </h5>
                                    <h6>
                                        <a href="{{route('public.post.browse',['category'=> $post->category->id])}}" class="text-info">
                                            {{$post->category->name}}
                                        </a>
                                    </h6>
                                    <p class="card-text">{{ $post->summary }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection