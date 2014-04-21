@extends('layouts.base')

@section('sidebar')
@parent
@stop

@section('content')

{{ Form::model($movie, array('route' => array('movies.update', $movie->id), 'method' => 'PUT')) }}

<p>
    {{ Form::label('title', 'Movie Title: ') }}
    {{ Form::text('title', Input::old('title')) }}
</p>
<p>
    {{ Form::label('genre', 'Genre: ') }}
    {{ Form::select('genre_id', $genres, Input::old('genre_id'))}}
</p>

<p>{{ Form::submit('Update') }}</p>
{{ Form::close() }}

@stop
