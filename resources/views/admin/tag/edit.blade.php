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
            Update Tag : {{ $tag->tag  }}
        </div>
        <div class="card-body">

            <form action="{{ @route('tag.update', ['id' => $tag->id]) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="tag">Tag</label>
                    <input class="form-control"  type="text" value="{{$tag->tag}}" name="tag" id="tag">
                </div>

                <div class="form-group">
                    <button class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection