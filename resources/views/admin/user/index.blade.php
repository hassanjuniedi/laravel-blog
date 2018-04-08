@extends('layouts.app')

@section('content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Avatar</th>
            <th>Name</th>
            <th>Edit</th>
            <th>Trash</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td><img src="{{asset($user->profile->avatar)}}" alt="" width="50px"></td>
                <td>{{$user->name}}</td>
                <td>
                    @if($user->admin)
                        <a href="{{route('user.toggle.admin', ['id' => $user->id])}}" class="btn btn-sm btn-danger">Remove permissions</a>
                    @else
                        <a href="{{route('user.toggle.admin', ['id' => $user->id])}}" class="btn btn-sm btn-success">Make Admin</a>
                    @endif
                </td>
                <td><a href="{{route('tag.delete', ['id' => $user->id])}}" class="btn btn-sm btn-danger">Trash</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection