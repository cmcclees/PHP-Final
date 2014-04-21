@extends('layouts.base')

@section('sidebar')
@parent
@stop

@section('content')
<h1>Users</h1>

<table class="dvds">
    <th class="dvds">Username</th>
    <th class="dvds">Email</th>
    <th class="dvds">Edit</th>
    <th class="dvds">Delete</th>
    @foreach ($users as $user)
    <tr>
        <td class="dvds">  {{$user->username}}</td>
        <td class="dvds">  {{$user->email}}</td>
        <td class="dvds">  <a href="{{ URL::to('users/' . $user->id . '/edit') }}">Edit</a></td>
        <td class="dvds">
            {{ Form::open(array('url' => 'users/' . $user->id)) }}
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit('Delete') }}
            {{ Form::close() }}
        </td>
    </tr>
    @endforeach
</table>
@stop