@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{route('type.create')}}" class="btn btn-primary">
            <i class="fa fa-plus"></i>
            <span>إضافة  نوع منشور </span>
        </a>
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>النوع</th>
            <th>تعديل</th>
            <th>حذف</th>
        </tr>
        </thead>
        <tbody>
        @foreach($types as $type)
            <tr>
                <td>{{$type->type}}</td>
                <td><a href="{{route('type.edit', ['id' => $type->id])}}" class="btn btn-sm btn-info">تعديل</a></td>
                <td><a href="{{route('type.delete', ['id' => $type->id])}}" class="btn btn-sm btn-danger">حذف</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection