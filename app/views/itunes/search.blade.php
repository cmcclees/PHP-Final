@extends('layouts.base')

@section('sidebar')
@parent
@stop

@section('content')

{{ Form::open(array('url' => 'addMovie')) }}

<!-- if there are login errors, show them here -->
<p>
    {{ $errors->first('movie_name') }}
</p>

<p>
    {{ Form::label('movie_name', 'Movie Title: ') }}
    {{ Form::text('movie_name', Input::old('movie_name'), array('placeholder' => 'ex: The Avengers')) }}
</p>

<p>{{ Form::submit('Submit!') }}</p>
{{ Form::close() }}

@stop