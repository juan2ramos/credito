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

    <h1>Emprendedoras con credito aprobado</h1>

    <div class="SearchBar" style="margin: 0 auto 20px;">
        <div class="search">
            {{ Form::open(['route' => 'searchUsers', 'method' => 'POST']) }}
            <button class="icon-search"></button>
            {{Form::input('text','search','',['class' => 'search-input'])}}
            {{Form::close()}}
        </div>
    </div>

    <div class="Table-content TabContainer" style="margin: 40px auto 0;">
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
                    <td>{{$user->second_name}}</td>
                    <td>{{$user->last_name}}</td>
                    <td>{{$user->second_last_name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <a href="{{route('userShow',$user['user_id'])}}" class="icon-folder-open "></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->appends(['sort' => 'users'])->links() }}
    </div>
@stop