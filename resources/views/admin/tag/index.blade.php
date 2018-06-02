@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{route('tag.create')}}" class="btn btn-primary">
            <i class="fa fa-plus"></i>
            <span>إضافة وسم </span>
        </a>
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>الوسم</th>
            <th>تعديل</th>
            <th>الحذف</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <td>{{$tag->tag}}</td>
                <td><a href="{{route('tag.edit', ['id' => $tag->id])}}" class="btn btn-sm btn-info">تعديل</a></td>
                <td><a href="{{route('tag.delete', ['id' => $tag->id])}}" class="btn btn-sm btn-danger">حذف</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection