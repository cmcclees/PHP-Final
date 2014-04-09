@extends('layouts.base')

@section('sidebar')
@parent
@stop

@section('content')
<p>Not Found? <a href="{{ URL::route('createMovieManually') }}">Insert Movie manually</a></p>
<table class="dvds">
    <th class="dvds">Title</th>
    <th class="dvds">Artwork</th>
    <th class="dvds">Description</th>
    <th class="dvds">Add?</th>
    @foreach ($results as $result)
    {{ Form::open(array('url' => 'createMovie', 'POST')) }}
    <tr>
        @if (!empty($result->trackName))
        <td class="dvds">{{ Form::text('movie_title', $result->trackName, array('readonly'))}}</td>
        @else
        <td class="dvds"></td>
        @endif


        @if (!empty($result->artworkUrl100))
        <td class="dvds">  <img src="{{$result->artworkUrl100;}}"></td>
        @else
        <td class="dvds"></td>
        @endif


        @if (!empty($result->longDescription))
        <td class="dvds">  {{$result->longDescription;}}</td>
        @else
        <td class="dvds"></td>
        @endif

        {{Form::hidden('genre', $result->primaryGenreName) }}

        <td class="dvds">{{ Form::submit('Add') }}</td>
    </tr>
    {{ Form::close() }}
    @endforeach
</table>
@stop