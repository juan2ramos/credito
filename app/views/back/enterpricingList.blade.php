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

    <div class="SearchBar" style="margin: 0 auto 20px;">
        <div class="search">
            {{ Form::open(['route' => 'searchUsers', 'method' => 'POST']) }}
            <button class="icon-search"></button>
            {{Form::input('text','search','',['class' => 'search-input'])}}
            {{Form::close()}}
        </div>
    </div>

    <nav class="UsersMenu">
        <ul>
            <li><a href="{{url('/admin/usuarios')}}">Creditos Lilipink</a></li>
            <li><a href="{{url('/admin/emprendedoras-contado')}}" class="active">Emprendedoras Contado</a></li>
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
                <th>Estado</th>
                @if(Auth::user()->roles_id == 1)
                <th>Acciones</th>
                @endif
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
                    <td>@if($user->user_state == 1)<span style="font-size: 1rem;color: #2ac52a;" class="icon-ok-circled big-icon"></span> @else <span style="font-size: 1rem;color: #e05151;" class="icon-cancel-circled"></span>@endif </td>
                    <td>
                        <!--<a href="{route('userShow',$user->id)}}" class="icon-folder-open "></a>-->
                        @if(Auth::user()->roles_id == 1)
                            @if(!$user->hasCredit)
                                @if($user->user_state == 1)
                                    <span style="font-size: 1.2rem" class="disabled icon-ok"></span>
                                    <a href="{{route('admin.disable.user', $user->id)}}" class="icon-cancel"></a>
                                @else
                                    <a href="{{route('admin.activate.user',$user->id)}}" class="icon-ok"></a>
                                    <span style="font-size: 1.2rem" class="disabled icon-cancel"></span>
                                @endif
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->appends(['sort' => 'users'])->links() }}
    </div>
@stop