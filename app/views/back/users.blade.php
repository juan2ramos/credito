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

    <h1>Usuarios Activos</h1>
    <!--<h1 xmlns="http://www.w3.org/1999/html">Administración de usuarios</h1>-->
    <div class="SearchBar" style="margin: 0 auto 20px;">
        <div class="Button">
            <a style="padding: 10px 15px;" class="u-button" href="{{route('searchUsersCard')}}">Usuarios que faltan por tarjeta</a>
        </div>
        <div class="wrap-content1">

        <?php $people = array(
            "andres.zambrano@lilipink.com",
            "carmen.lopez@lilipink.com",
            "harvy.pachon@lilipink.com",
            "hernesto.rojas@lilipink.com",
            "jonathan.sogamoso@lilipink.com",
            "miguel.quijano@lilipink.com",
            "diego.bermudez@lilipink.com"
            ) ?>

        @if(Auth::user()->roles_id == 1 || in_array(Auth::user()->email, $people))
                <a href="{{route('usersExcel')}}" class="icon-file-excel"></a>
            @endif
            <!--<a href="{route('usersPdf')}}" class="icon-file-pdf"></a>-->
        </div>
        <div class="search">
            {{ Form::open(['route' => 'searchUsers', 'method' => 'POST']) }}
            <button class="icon-search"></button>
            {{Form::input('text','search','',['class' => 'search-input'])}}
            {{Form::close()}}
        </div>
    </div>

    <nav class="UsersMenu">
        <ul>
            <li><a href="{{url('/admin/usuarios')}}" class="active">Creditos Lilipink</a></li>
            <li><a href="{{url('/admin/emprendedoras-contado')}}">Emprendedoras Contado</a></li>
            <li><a href="{{url('/admin/emprendedoras-credito')}}">Emprendedoras Credito</a></li>
        </ul>
    </nav>
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
                <th>Fecha de solicitud</th>
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
                    <td>{{$user->created_at}}</td>
                    <td>
                        <a href="{{route('userShow',$user->id)}}" class="icon-folder-open "></a>
                        @if(Auth::user()->roles_id==1)
                            <a href="{{route('userDelete',$user->id)}}" class="icon-trash-empty "></a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->appends(['sort' => 'users'])->links() }}
    </div>

    @if(Auth::user()->roles_id==1)
        <div class="wrap-content ">
            <a href="{{route('userNew')}}" class="u-more u-link">+</a>
        </div>
    @endif
@stop