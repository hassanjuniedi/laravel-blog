@extends('layouts.public')

@section('content')
    <!-- Page Header -->
    <header class="masthead mb-0" style="background-image: url('{{url($post->featured)}}')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-heading">
                        <h1>{{$post->title}}</h1>
                        <span class="meta">تم النشر بواسطة
                            <a href="#">{{$post->user->name}}</a>  بتاريخ
                            {{$post->created_at->format('d/m/Y - H:i') }}
                        </span>
                        <div class="mt-2 tags">
                            @foreach($post->tags as $tag)
                                <a href="{{route('public.post.browse',['tag[]'=> $tag->id])}}" class="badge badge-info">
                                    <i class="fa fa-tag"></i>
                                    {{$tag->tag}}
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('public.post.browse')}}">المنشورات</a></li>
        <li class="breadcrumb-item"><a href="{{route('public.post.browse', ['category'=> $post->category->id])}}">{{$post->category->name}}</a></li>
        <li class="breadcrumb-item active">{{$post->title}}</li>
    </ol>

    <div class="container">
        <div class="row">
            <div class="col-lg-2">

            </div>
            <div class="col-lg-8 col-md-10">
                <article>
                    {!! $post->content !!}
                </article>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class=call-to-action>
                    <a class="btn btn-success" href="{{url($post->download_url)}}">
                        <i class="fa fa-download"></i>
                        <span>تحميل</span>
                    </a>
                </div>
            </div>
        </div>
    </div>


@endsection