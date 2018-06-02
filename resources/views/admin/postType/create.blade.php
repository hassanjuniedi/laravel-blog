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
            إضافة نوع منشور
        </div>
        <div class="card-body">

            <form action="{{ @route('type.store') }}" method="post" >
                @csrf
                <div class="form-group">
                    <label for="type">النوع</label>
                    <input class="form-control"  type="text" name="type" id="type">
                </div>

                <div class="form-group">
                    <button class="btn btn-default">حفظ</button>
                </div>
            </form>
        </div>
    </div>
@endsection