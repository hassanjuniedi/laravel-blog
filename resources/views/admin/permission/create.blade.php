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
            إضافة صلاحية جديد
        </div>
        <div class="card-body">

            <form action="{{ @route('permission.store') }}" method="post" >
                @csrf
                <div class="form-group">
                    <label for="permission">اسم الصلاحية</label>
                    <input class="form-control"  type="text" name="permission" id="permission">
                </div>
                <div class="form-group">
                    <button class="btn btn-default">حفظ</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {

            $('#permissions').select2();

        })
    </script>
@endsection