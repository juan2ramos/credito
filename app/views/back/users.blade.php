@extends('layout.front')
@section('title') Usuarios @stop
@section('content')

    <h1 xmlns="http://www.w3.org/1999/html">Admnistración de usuarios</h1>
    <div class="search">
        {{ Form::open(['route' => 'searchUsers', 'method' => 'POST']) }}
        <button class="icon-search"></button>
        {{Form::input('text','search','',['class' => 'search-input'])}}
        {{Form::close()}}
    </div>

    <div class="Table-content">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Segundo Nombre</th>
                <th>Apellido</th>
                <th>Segundo Apellido</th>
                <th>E-mail</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->identification_card}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->last_name}}</td>
                    <td>{{$user->user_name}}</td>
                    <td>{{$user->user_name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <a href="{{route('userShow',$user->id)}}" class="icon-folder-open "></a>
                        <a href="" class="icon-trash-empty "></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{  $users->links(); }}
@stop