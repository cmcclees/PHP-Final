<html>
<head>
    {{ HTML::style('/css/style.css') }}
</head>
<body>
@section('sidebar')
    <div id="sidebar">
        @if(Auth::check())
        Username: {{Auth::user()->username}}
        @endif
    </div>
@show
<div id="container">
    <div id="nav">
        <ul>
            @if(Auth::check())
            <li><a href="{{ URL::route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ URL::route('movieSearch') }}">Search My Movies</a></li>
            <li><a href="{{ URL::route('addMovie')}}">Add Movie</a></li>
            <li><a href="{{ URL::route('watchedMovieList') }}">Watched Movies</a></li>
            <li><a href="{{ URL::route('logout') }}">Logout</a></li>
            @endif
        </ul>
    </div><!-- end nav -->

    <!-- check for error flash var -->
    <!--@if (Session::has('flash_error'))
    <div id="flash_error">{{ Session::get('flash_error') }}</div>
    @endif-->
    <!-- check for flash notification message -->
    @if(Session::has('flash_notice'))
    <div id="flash_notice">{{ Session::get('flash_notice') }}</div>
    @endif

    @if(Session::has('errors'))
    <ul id="flash_error">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    @yield('content')
</div><!-- end container -->
</body>
</html>