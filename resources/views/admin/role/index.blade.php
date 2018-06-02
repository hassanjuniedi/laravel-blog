@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{route('role.create')}}" class="btn btn-primary">
            <i class="fa fa-plus"></i>
            <span>إضافة دور </span>
        </a>
        <a href="{{route('permission.index')}}" class="btn btn-success">
            <i class="fa fa-bars"></i>
            <span>الصلاحيات المتوفرة </span>
        </a>
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th width="80%">الدور</th>
            <th>تعديل</th>
            <th>الحذف</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr>
                <td>{{$role->name}}</td>
                <td><a href="{{route('role.edit', ['id' => $role->id])}}" class="btn btn-sm btn-info">تعديل</a></td>
                <td><a href="{{route('role.destroy', ['id' => $role->id])}}" class="btn btn-sm btn-danger">حذف</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection