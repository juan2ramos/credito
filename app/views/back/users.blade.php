@extends('layout.front')
@section('title') Usuarios @stop
@section('content')
    <div class="container">
        @foreach ($users as $user)
        {{$user->name}}
         @endforeach
    </div>

    {{  $users->links(); }}
@stop