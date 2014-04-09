@extends('layouts.base')

@section('sidebar')
@parent
@stop

@section('content')

{{ Form::open(array('url' => 'insertMovie')) }}

<p>
    {{ Form::label('movie_title', "Movie Title:") }}
    {{ Form::text('movie_name', $title, array('placeholder' => 'ex: The Avengers')) }}
</p>
<p>
    {{--from the api search if i can, if not give an idea?--}}
    {{ "Suggested Genre: $genre_itunes" }}
    </br>
    {{ Form::label('genre', 'Genre: ') }}
    {{ Form::select('genre_id', $genres, Input::old('genre_id'))}}
</p>
<p>
    {{ Form::label('device', 'Device: ') }}
    {{ Form::select('device_id', $devices, Input::old('device_id'))}}
</p>

<p>{{ Form::submit('Insert') }}</p>
{{ Form::close() }}

@stop

