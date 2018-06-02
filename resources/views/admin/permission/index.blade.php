@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{route('permission.create')}}" class="btn btn-primary">
            <i class="fa fa-plus"></i>
            <span>إضافة صلاحية </span>
        </a>
        <a href="{{route('role.index')}}" class="btn btn-success">
            <i class="fa fa-bars"></i>
            <span>الأدوار </span>
        </a>
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th width="80%">الصلاحية</th>
            <th>تعديل</th>
            <th>الحذف</th>
        </tr>
        </thead>
        <tbody>
        @foreach($permissions as $permission)
            <tr>
                <td>{{$permission->name}}</td>
                <td><a href="{{route('permission.edit', ['id' => $permission->id])}}" class="btn btn-sm btn-info">تعديل</a></td>
                <td><a href="{{route('permission.destroy', ['id' => $permission->id])}}" class="btn btn-sm btn-danger">حذف</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection