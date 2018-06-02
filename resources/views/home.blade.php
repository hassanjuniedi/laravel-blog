@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">نظرة عامة</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @role('مدير')
                <div class="row">
                    <div class="col-3">
                        <a href="#" class="text-center d-block badge-danger py-4 rounded">
                            <h4>المستخدمين</h4>
                            <i class="fa fa-users fa-2x"></i>
                            <h4 class="mt-2">{{$stats['users']}}</h4>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="#" class="text-center d-block badge-success py-4 rounded">
                            <h4>المنشورات</h4>
                            <i class="fa fa-book fa-2x"></i>
                            <h4 class="mt-2">{{$stats['posts']}}</h4>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="#" class="text-center d-block badge-warning py-4 rounded">
                            <h4>الفئات</h4>
                            <i class="fa fa-th-large fa-2x"></i>
                            <h4 class="mt-2">{{$stats['cats']}}</h4>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="#" class="text-center d-block badge-info py-4 rounded">
                            <h4>الوسوم</h4>
                            <i class="fa fa-tags fa-2x"></i>
                            <h4 class="mt-2">{{$stats['tags']}}</h4>
                        </a>
                    </div>
                </div>
                @else
                <span>اهلا</span>
                <strong>{{Auth::user()->name}}, </strong>
                <span>في مجلة جامعة تشرين</span>
            @endrole
        </div>
    </div>
@endsection
