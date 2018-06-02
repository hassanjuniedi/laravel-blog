@extends('layouts.public')

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('{{ url('img/home-bg.jpg') }}')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>مجلة جامعة تشرين</h1>
                        <span class="subheading">للبحوث والدراسات العلمية</span>
                        <div class="mt-4">
                            <a href="{{route('public.post.browse')}}" class="btn btn-primary">
                                <i class="fa fa-bars"></i>
                                <span>استعراض</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <h2 class="mb-4">آخر المنشورات:</h2>
        <div class="card-columns">
            @foreach($posts as $post)
                <div class="card d-inline-block">
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
            @endforeach
        </div>
    </div>
@endsection