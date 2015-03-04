@extends('layout.front')
@section('title') Usuarios @stop
@section('content')
    @include('layout.notify')
    @if(Session::get('message'))

        <script>
            var notify = document.getElementById('notify');
            notify.classList.add('is-show');
            notify.classList.add('success');
            notify.querySelector('.text-notify').innerText = '{{Session::get('message')}}';
        </script>
    @endif

    <h1 xmlns="http://www.w3.org/1999/html">Admnistración de usuarios</h1>
    <div class="search">
        {{ Form::open(['route' => 'searchUsers', 'method' => 'POST']) }}
        <button class="icon-search"></button>
        {{Form::input('text','search','',['class' => 'search-input'])}}
        {{Form::close()}}
    </div>
    <div class="wrap-content">
        <a href="{{route('usersExcel')}}" class="icon-file-excel"></a>
        <a href="{{route('usersPdf')}}" class="icon-file-pdf"></a>
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
                        <a href="{{route('userDelete',$user->id)}}" class="icon-trash-empty "></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{  $users->links(); }}
    <div class="wrap-content ">
        <a href="{{route('userNew')}}" class="u-more u-link">+</a>
    </div>
@stop