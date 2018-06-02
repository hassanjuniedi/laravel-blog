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
            Update Type : {{ $type->type  }}
        </div>
        <div class="card-body">

            <form action="{{ @route('type.update', ['id' => $type->id]) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="type">Type</label>
                    <input class="form-control"  type="text" value="{{$type->type}}" name="type" id="type">
                </div>

                <div class="form-group">
                    <button class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection