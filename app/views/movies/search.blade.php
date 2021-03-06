@extends('layouts.base')

@section('sidebar')
@parent
@stop

@section('content')

{{ Form::open(array('url' => 'searchedMovieList')) }}

<!-- if there are login errors, show them here -->
<p>
    {{ $errors->first('movie_name') }}
</p>

<p>
    {{ Form::label('title', 'Movie Title: ') }}
    {{ Form::text('title', Input::old('title'), array('placeholder' => 'ex: The Avengers')) }}
</p>
<p>
    {{ Form::label('genre', 'Genre: ') }}
    {{ Form::select('genre_id', $genres, Input::old('genre_id'))}}
</p>

<p>{{ Form::submit('Search') }}</p>
{{ Form::close() }}

@stop
