@extends('layouts.app')

@section('content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Restore</th>
            <th>Destroy</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td><img src="{{$post->featured}}" alt="" width="80px"></td>
                <td>{{$post->title}}</td>
                <td><a href="{{route('post.restore', ['id' => $post->id])}}" class="btn btn-sm btn-info">Restore</a></td>
                <td><a href="{{route('post.kill', ['id' => $post->id])}}" class="btn btn-sm btn-danger">Destroy</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection