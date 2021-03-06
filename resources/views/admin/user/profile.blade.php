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
            User Profile
        </div>
        <div class="card-body">

            <form action="{{ @route('user.profile.update') }}" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control"  type="text" name="name" id="name" value="{{$user->name}}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control"  type="email" name="email" id="email" value="{{$user->email}}">
                </div>

                <div class="form-group">
                    <label for="password">New Password</label>
                    <input class="form-control"  type="password" name="password" id="password">
                </div>

                <div class="form-group">
                    <label for="facebook">Facebook profile</label>
                    <input class="form-control"  type="url" name="facebook" id="facebook" value="{{$user->profile->facebook}}">
                </div>

                <div class="form-group">
                    <label for="twitter">Twitter profile</label>
                    <input class="form-control"  type="url" name="twitter" id="twitter" value="{{$user->profile->twitter}}">
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-2">
                            <img src="{{asset($user->profile->avatar)}}" alt="" class="img-thumbnail">
                        </div>
                        <div class="col-8">
                            <label for="avatar">Avatar</label>
                            <input class="form-control" type="file" name="avatar" id="avatar">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="about">About</label>
                    <textarea name="about" id="about" rows="5" class="form-control">{{$user->profile->about}}</textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <br>
    @if(isset($roles) )
    <div class="card">
        <div class="card-header">
            إدارة أدوار المستخدم
        </div>
        <div class="card-body">
            <form action="{{ @route('user.roles.update', ['id' => $user->id]) }}" method="post">
                @csrf
                <input type="hidden" name="_method" value="put">
                <div class="form-group">
                    <label for="roles">الصلاحيات</label>
                    <select name="role[]" id="roles" class="form-control" multiple="multiple">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}" @if(in_array($role->name, $user->getRoleNames()->all()) ) selected="selected" @endif>
                                {{$role->name}}
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
    @endif
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {

            $('#roles').select2();

        })
    </script>
@endsection

