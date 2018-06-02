@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{route('user.create')}}" class="btn btn-primary">
            <i class="fa fa-plus"></i>
            <span>إضافة مستخدم</span>
        </a>
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>الصورة</th>
            <th width="60%">Name</th>
            {{--<th>الصلاحيات</th>--}}
            <th>تعديل</th>
            <th>حذف</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td><img src="{{asset($user->profile->avatar)}}" alt="" width="50px"></td>
                <td>{{$user->name}}</td>
                {{--<td>--}}
                    {{----}}
                    {{--@if($user->admin)--}}
                        {{--<a href="{{route('user.toggle.admin', ['id' => $user->id])}}" class="btn btn-sm btn-danger">Remove permissions</a>--}}
                    {{--@else--}}
                        {{--<a href="{{route('user.toggle.admin', ['id' => $user->id])}}" class="btn btn-sm btn-success">Make Admin</a>--}}
                    {{--@endif--}}
                {{--</td>--}}
                <td><a href="{{route('user.edit', ['id' => $user->id])}}" class="btn btn-sm btn-info">تعديل</a></td>
                <td><a href="{{route('user.delete', ['id' => $user->id])}}" class="btn btn-sm btn-danger">حذف</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
