@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{route('category.create')}}" class="btn btn-primary">
            <i class="fa fa-plus"></i>
            <span>إضافة فئة</span>
        </a>
    </div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{$category->name}}</td>
                <td><a href="{{route('category.edit', ['id' => $category->id])}}" class="btn btn-info">Edit</a></td>
                <td><a href="{{route('category.delete', ['id' => $category->id])}}" class="btn btn-danger">Delete</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection