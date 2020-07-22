<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body, main {
            background-color: rgb(252, 14, 159);
            /*color: #636b6f;*/
        }
    </style>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/styles/atom-one-dark.min.css">
    {{--<link href="{{ asset('toastr/toastr.min.css') }}" rel="stylesheet">--}}
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Left Side Of Navbar -->
                <span></span>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('forum') }}">Home</a>
                    </li>

                    <li class="nav-item dropdown">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            My Forum <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item"
                               href="/forum?filter=me">
                                {{ __('My Discussions') }}
                            </a>
                            <a class="dropdown-item"
                               href="/forum?filter=solved">
                                {{ __('Closed Discussions') }}
                            </a>
                            <a class="dropdown-item"
                               href="/forum?filter=unsolved">
                                {{ __('Open Discussions') }}
                            </a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contactformcreate') }}">Contact Us</a>
                    </li>

                    {{--<li class="nav-item">
                        <a class="nav-link" href="{{ route('forum') }}">How</a>
                    </li>--}}

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>

                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Welcome {{ Auth::user()->name }}
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item"
                                   href="{{ route('profiles.show', ['user_id'=> Auth::user()->id]) }}">
                                    {{ __('My Profile') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
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
                <div class="col-md-4">

                    <!-- Create new discussion button -->
                    <a href="{{route('discussions.create')}}" style="color: white;"
                       class="form-control btn btn-outline-secondary mb-1">
                        Create a new Discussion
                    </a>

                    <!-- Search for discussions form -->
                    <form class="form-inline mb-3" method="GET" action="{{route('search')}}">
                        @csrf
                        <input class="form-control mr-auto col-lg-9 col-9" name="search" type="search"
                               placeholder="Search discussion(s)"
                               aria-label="Search" value="{{ request()->query('search') }}">
                        <button class="btn btn-outline-secondary my-2 my-sm-0" style="color: white" type="submit">
                            Search
                        </button>
                    </form>

                    <!-- Administrators buttons for channels and users -->
                    @if(Auth::check())
                        @if(Auth::user()->admin)
                            <div class="card mb-1">
                                <div class="card-body">
                                    <ul class="list-group">
                                        <a href="/channels" class="list-group-item list-group-item-action">
                                            Edit Channels
                                        </a>
                                        <a href="/users" class="list-group-item list-group-item-action">
                                            Edit Users
                                        </a>
                                    </ul>
                                </div>
                            </div>
                    @endif
                @endif

                <!-- List of channels for all users -->
                    <div class="card mb-2">
                        <div class="card-header">Channels</div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($channels as $channel)

                                    <a href="{{route('channel', ['slug'=>$channel->slug])}}"
                                       class="list-group-item list-group-item-action">{{$channel->title}}</a>

                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">

                    @if($errors->count() > 0)
                        <div class="card">
                            <ul class="card-header mb-0">
                                @foreach($errors->all() as $error)
                                    <li class="list-group-item text-light bg-secondary">
                                        {{$error}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')

                </div>
            </div>
        </div>
    </main>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.js"></script>
<script>
    @if(Session::has('success'))
    toastr.success('{{ Session::get('success')}}')
    @endif
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/highlight.min.js"></script>
{{--<script>hljs.initHighlightingOnLoad();</script>--}}

</body>
</html>
