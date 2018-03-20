<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CMSBolg') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    @yield('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                @if(Auth::check())
                <div class="col-md-4">

                        <ul class="list-group ">
                            <li class=" list-group-item list-group-item-heading list-group-item-info "><h3>Content List</h3> </li>
                            <li class="list-group-item "><a href="{{route('home')}}">Home</a> </li>
                            <li class="list-group-item "><a href="{{route('posts')}}">Posts</a> </li>

                            <li class="list-group-item "><a href="{{route('tags')}}">Tags</a> </li>
                            <li class="list-group-item"><a href="{{route('categories')}}">Categories</a> </li>
                            @if(Auth::user()->admin)
                                <li class="list-group-item "><a href="{{route('users')}}">Users</a> </li>
                                <li class="list-group-item"><a href="{{route('user.create')}}">Create New User</a> </li>

                            @endif
                            <li class="list-group-item"><a href="{{route('post.create')}}">Create New Post</a> </li>

                            <li class="list-group-item "><a href="{{route('tag.create')}}">Create New Tag</a> </li>
                            <li class="list-group-item"><a href="{{route('category.create')}}">Create New Category</a> </li>
                            <li class="list-group-item"><a href="{{route('post.trash')}}">Trashed Posts</a> </li>
                            <li class="list-group-item"><a href="{{route('user.edit')}}">Edit Profile</a> </li>
                            @if(Auth::user()->admin)
                            <li class="list-group-item"><a href="{{route('settings.update')}}">Settings</a> </li>

                            @endif
                        </ul>



                </div>
                @endif
                <div class="col-md-8">
                    @yield('content')
                </div>
            </div>
        </div>


    </div>

    <!-- Scripts -->
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        @if(Session::has('message'))
            Command: toastr["success"]("{{Session::get('message')}}");
        @endif
                @if(Session::has('info'))
            Command: toastr["info"]("{{Session::get('info')}}");
        @endif
                @if(Session::has('warnning'))
            Command: toastr["warnning"]("{{Session::get('warnning')}}");
        @endif

    </script>
    @yield('scripts')
</body>
</html>
