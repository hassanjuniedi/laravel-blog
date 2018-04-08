@extends('layouts.app')

@section('content')
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