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
            Update Category : {{ $category->name  }}
        </div>
        <div class="card-body">

            <form action="{{ @route('category.update', ['id' => $category->id]) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">name</label>
                    <input class="form-control"  type="text" value="{{$category->name}}" name="name" id="name">
                </div>

                <div class="form-group">
                    <button class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection