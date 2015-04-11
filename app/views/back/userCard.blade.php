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

    <h1 xmlns="http://www.w3.org/1999/html">Administración de usuarios</h1>
    <div class="search">
        {{ Form::open(['route' => 'searchUsers', 'method' => 'POST']) }}
        <button class="icon-search"></button>
        {{Form::input('text','search','',['class' => 'search-input'])}}
        {{Form::close()}}
    </div>
    <div class="wrap-content1">
        <a href="{{route('usersExcel')}}" class="icon-file-excel"></a>
        <a href="{{route('usersPdf')}}" class="icon-file-pdf"></a>
    </div>
    <div class="Table-content">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Credito aprobado</th>
                <th>Fecha de aprovacion</th>
                <th>Punto de Venta</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                @if(Auth::user()->roles_id==3)
                    @if(Auth::user()->location==$user->location and $user->roles_id==4)
                        <tr>
                            <td>{{$user->identification_card}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>${{$user->creditRequest['value']}}</td>
                            <td>{{$user->updated_at}}</td>
                            @foreach($points as $point)
                                @if($user->creditRequest['point']==$point->id)
                                    <td>{{$point->name}}</td>
                                @else
                                    <td>No definido</td>
                                @endif
                            @endforeach
                            <td>
                                <a href="{{route('userShow',$user->id)}}" class="icon-folder-open "></a>
                                <a href="{{route('userDelete',$user->id)}}" class="icon-trash-empty "></a>
                            </td>
                        </tr>
                    @endif
                @else
                    @if($user->roles_id==4)
                        <tr>
                            <td>{{$user->identification_card}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>${{$user->creditRequest['value']}}</td>
                            <td>{{$user->updated_at}}</td>
                            <td>{{$user->creditRequest['point']}}</td>
                            <td>
                                <a href="{{route('userShow',$user->id)}}" class="icon-folder-open "></a>
                                <a href="{{route('userDelete',$user->id)}}" class="icon-trash-empty "></a>
                            </td>
                        </tr>
                    @endif
                @endif

            @endforeach
            </tbody>
        </table>
    </div>
    <div class="wrap-content ">
        <a href="{{route('userNew')}}" class="u-more u-link">+</a>
    </div>
@stop