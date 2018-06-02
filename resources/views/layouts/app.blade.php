<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vendor.css') }}" rel="stylesheet">
    @yield('stylesheets')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    لوحة التحكم
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row">
                    @if(Auth::check())
                        <div class="col-4">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="{{ route('dashboard') }}">
                                        <i class="fa fa-home"></i>
                                        <span>الرئيسية</span>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('user.profile') }}">
                                        <i class="fa fa-user"></i>
                                        <span>حسابي</span>
                                    </a>
                                </li>
                                @role('مؤلف|مدير')
                                <li class="list-group-item">
                                    <a href="{{ route('post.index') }}">
                                        <i class="fa fa-file"></i>
                                        <span>المنشورات</span>
                                    </a>
                                </li>
                                @endrole
                                @role('مدير')
                                <li class="list-group-item">
                                    <a href="{{ route('category.index') }}">
                                        <i class="fa fa-th-large"></i>
                                        <span>الفئات</span>
                                    </a>
                                </li>


                                <li class="list-group-item">
                                    <a href="{{ route('type.index') }}">
                                        <i class="fa fa-tags"></i>
                                        <span>انماط المنشورات</span>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('tag.index') }}">
                                        <i class="fa fa-tags"></i>
                                        <span>الوسوم</span>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('user.index') }}">
                                        <i class="fa fa-users"></i>
                                        <span>المستخدمين</span>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('role.index') }}">
                                        <i class="fa fa-users"></i>
                                        <span>الأدوار والصلاحيات</span>
                                    </a>
                                </li>

                                <li class="list-group-item">
                                    <a href="{{ route('post.trashed') }}">
                                        <i class="fa fa-trash-o"></i>
                                        <span>المهملات</span>
                                    </a>
                                </li>
                                @endrole
                            </ul>
                        </div>
                        <div class="col-8">
                            @yield('content')
                        </div>
                    @else
                        @yield('content')
                    @endif

                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script>
        @if(Session::has('success'))
            toastr.success('{{ Session::get("success")}} ');
        @endif
        @if(Session::has('error'))
        toastr.error('{{ Session::get("error")}} ');
        @endif
    </script>
    @yield('scripts')
</body>
</html>
