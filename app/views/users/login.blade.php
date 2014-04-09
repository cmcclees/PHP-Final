@extends('layouts.base')

@section('sidebar')
@parent
@stop

@section('content')

<h1>Login</h1>


{{ Form::open(array('url' => 'login', 'POST')) }}
<!-- if there are login errors, show them here -->
<p>
    {{ $errors->first('username') }}
    {{ $errors->first('password') }}
</p>

<p>
    {{ Form::label('username', 'Username: ') }}
    {{ Form::text('username', Input::old('username'), array('placeholder' => 'JDoe')) }}
</p>

<p>
    {{ Form::label('password', 'Password:') }}
    {{ Form::password('password') }}
</p>

<p>{{ Form::submit('Login') }}</p>
{{ Form::close() }}

Don't have an account? <a href="{{URL::route('register') }}">Sign up!</a>
@stop

