@extends('layouts.base')

@section('sidebar')
@parent
@stop

@section('content')

<h1>Register</h1>


{{ Form::open(array('url' => 'register', 'POST')) }}
<!-- if there are login errors, show them here -->

<p>
    {{ Form::label('username', 'Username: ') }}
    {{ Form::text('username', Input::old('username')) }}
</p>
<p>
    {{Form::label('email', 'Email: ') }}
    {{ Form::text('email', null, Input::old('email')) }}
</p>

<p>
    {{ Form::label('password', 'Password:') }}
    {{ Form::password('password') }}
</p>

<p>
    {{ Form::label('password_confirmation', 'Confirm Password:') }}
    {{ Form::password('password_confirmation') }}
</p>



<p>{{ Form::submit('Register') }}</p>
{{ Form::close() }}

@stop
