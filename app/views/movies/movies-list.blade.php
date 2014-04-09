@extends('layouts.base')

@section('sidebar')
@parent
@stop

@section('content')
<h1>My Movies</h1>

<table class="dvds">
    <th class="dvds">Title</th>
    <th class="dvds">Genre</th>
    <th class="dvds">Viewing Device</th>
    @foreach ($movies as $movie)
        <tr>
            <td class="dvds">  {{$movie->title;}}</td>
            <td class="dvds">  {{$movie->genre->genre_name;}}</td>
            <td class="dvds">  {{$devices[$movie->pivot->device_id]}}</td>
        </tr>
    @endforeach
</table>
@stop
