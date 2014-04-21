@extends('layouts.base')

@section('sidebar')
@parent
@stop

@section('content')
<h1>Edit {{$user->username}}</h1>

{{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}

<p>
    {{ Form::label('username', 'Username: ') }}
    {{ Form::text('username', Input::old('username')) }}
</p>
<p>
    {{Form::label('email', 'Email: ') }}
    {{ Form::text('email', null, Input::old('email')) }}
</p>


<p>{{ Form::submit('Update') }}</p>
{{ Form::close() }}

@stop
