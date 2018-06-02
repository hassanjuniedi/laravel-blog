@extends('layouts.app')

@section('content')
    <h2>
        <i class="fa fa-trash-o"></i>
        <span>سلة المحذوفات</span>
    </h2>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>الصورة</th>
            <th width="60%">العنوان</th>
            <th>استعادة</th>
            <th>حذف نهائي</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td><img src="{{$post->featured}}" alt="" width="80px"></td>
                <td>{{$post->title}}</td>
                <td><a href="{{route('post.restore', ['id' => $post->id])}}" class="btn btn-sm btn-info">استعادة</a></td>
                <td><a href="{{route('post.kill', ['id' => $post->id])}}" class="btn btn-sm btn-danger">حذف</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection