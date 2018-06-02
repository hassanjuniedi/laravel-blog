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
            تعديل الدور : {{ $role->name  }}
        </div>
        <div class="card-body">

            <form action="{{ @route('role.update', ['id' => $role->id]) }}" method="post">
                @csrf
                <input type="hidden" name="_method" value="put">
                <div class="form-group">
                    <label for="role">اسم الدور</label>
                    <input class="form-control"  type="text" value="{{$role->name}}" name="role" id="role">
                </div>
                <div class="form-group">
                    <label for="permissions">الصلاحيات</label>
                    <select name="permission[]" id="permissions" class="form-control" multiple="multiple">
                        @foreach($permissions as $permission)
                            <option value="{{$permission->id}}" @if(in_array($permission->id, $role->permissions->pluck('id')->all())) selected="selected" @endif>
                                {{$permission->name}}
                            </option>
                        @endforeach
                    </select>
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