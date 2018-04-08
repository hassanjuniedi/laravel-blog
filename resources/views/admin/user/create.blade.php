@extends('layouts/app')

@section('content')
    <ul class="list-group">
        @foreach($errors->all() as $error)
            <li class="list-group-item text-danger">
                {{$error}}
            </li>
        @endforeach
    </ul>
    <div class="card">
        <div class="card-header">
            Create New User
        </div>
        <div class="card-body">

            <form action="{{ @route('user.store') }}" method="post" >
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control"  type="text" name="name" id="name">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control"  type="email" name="email" id="email">
                </div>

                <div class="form-group">
                    <button class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection