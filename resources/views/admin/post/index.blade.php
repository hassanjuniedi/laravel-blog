@extends('layouts.app')

@section('content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Edit</th>
            <th>Trash</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td><img src="{{$post->featured}}" alt="" width="80px"></td>
                <td>{{$post->title}}</td>
                <td><a href="{{route('post.edit', ['id' => $post->id])}}" class="btn btn-sm btn-info">Edit</a></td>
                <td><a href="{{route('post.delete', ['id' => $post->id])}}" class="btn btn-sm btn-danger">Trash</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection