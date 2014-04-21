@extends('layouts.base')

@section('sidebar')
@parent
@stop

@section('content')
<h1>Movies</h1>

<table class="dvds">
    <th class="dvds">Title</th>
    <th class="dvds">Genre</th>
    <th class="dvds">Edit</th>
    <th class="dvds">Delete</th>
    @foreach ($movies as $movie)
    <tr>
        <td class="dvds">  {{$movie->title}}</td>
        <td class="dvds">  {{$movie->genre->genre_name}}</td>
        <td class="dvds">  <a href="{{ URL::to('movies/' . $movie->id . '/edit') }}">Edit</a></td>
        <td class="dvds">
            {{ Form::open(array('url' => 'movies/' . $movie->id)) }}
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit('Delete') }}
            {{ Form::close() }}
        </td>
    </tr>
    @endforeach
</table>
@stop