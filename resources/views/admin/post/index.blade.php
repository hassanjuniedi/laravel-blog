@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{route('post.create')}}" class="btn btn-primary">
            <i class="fa fa-plus"></i>
            <span>إضافة منشور</span>
        </a>
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>الصورة</th>
            <th>العنوان</th>
            <th>تعديل</th>
            <th>حذف</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td><img src="{{$post->featured}}" alt="" width="80px"></td>
                <td><a href="{{route('post.show', ['id' => $post->id])}}">{{$post->title}}</a></td>
                <td><a href="{{route('post.edit', ['id' => $post->id])}}" class="btn btn-sm btn-info">تعديل</a></td>
                <td><a href="{{route('post.delete', ['id' => $post->id])}}" class="btn btn-sm btn-danger">حذف</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection