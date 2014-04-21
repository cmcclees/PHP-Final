@extends('layouts.base')

@section('sidebar')
@parent
@stop

@section('content')
<p><a href="{{ URL::route('createMovieManually') }}">Insert Movie manually</a></p>
{{ Form::open(array('url' => 'addMovie')) }}

<!-- if there are login errors, show them here -->
<p>
    {{ $errors->first('movie_name') }}
</p>

<p>
    {{ Form::label('title', 'Movie Title: ') }}
    {{ Form::text('title', Input::old('title'), array('placeholder' => 'ex: The Avengers')) }}
</p>

<p>{{ Form::submit('Submit!') }}</p>
{{ Form::close() }}

@stop