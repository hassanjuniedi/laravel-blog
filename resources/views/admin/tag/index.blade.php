@extends('layouts.app')

@section('content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Tag</th>
            <th>Edit</th>
            <th>Trash</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <td>{{$tag->tag}}</td>
                <td><a href="{{route('tag.edit', ['id' => $tag->id])}}" class="btn btn-sm btn-info">Edit</a></td>
                <td><a href="{{route('tag.delete', ['id' => $tag->id])}}" class="btn btn-sm btn-danger">Trash</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection