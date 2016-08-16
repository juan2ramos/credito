@extends('layout.front')
@section('content')
    @include('layout.notify')
    @if($errors->first('name'))
        <script>
            var notify = document.getElementById('notify');
            notify.classList.add('is-show');
            notify.classList.add('error');
            notify.querySelector('.text-notify').innerText = '{{$errors->first('name')}}';
        </script>
    @endif
    @if(Session::get('message'))
        <script>
            var notify = document.getElementById('notify');
            notify.classList.add('is-show');
            notify.classList.add('success');
            notify.querySelector('.text-notify').innerText = '{{Session::get('message')}}';
        </script>
    @endif
    <h1>Roles</h1>
    <div class="Table-content">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Prioridad Aprobación de crédito</th>
                <th>Ver permisos</th>
                <th>Eliminar</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td>
                        @if(Lang::has('utils.roles.'.$role->name))
                            {{Lang::get('utils.roles.'.$role->name)}}
                        @else
                            {{$role->name}}
                        @endif
                    </td>
                    <td>
                        @if($role->priority == 1)
                            Alta
                        @elseif($role->priority == 2)
                            Media
                        @else
                            Baja
                        @endif
                    </td>
                    <td>
                        <a href="{{route('rol', $role->id)}}" class="icon-folder-open"></a>
                    </td>
                    <td>
                        <a href="{{route('deleteRol', $role->id)}}" class="icon-trash-empty"
                           onClick="return confirm('Estas seguro de eliminar el rol?')">
                        </a>
                    </td>
                </tr>
            @endforeach
            <tr>

            </tr>
            </tbody>
        </table>

    </div>
    <div class="Input-more">
        {{Form::model($role, array('route' => array('newRol')))}}
        {{Form::text('name','',['id' => 'Input-more','placeholder' => 'Nombre del nuevo rol'])}}

        {{Form::label('priority','Prioridad',['class' => 'Label-priority'])}}
        {{Form::checkbox('priority', 1, false, ['class' => 'checkbox',])}}

        <button class="u-more">+</button>
        {{Form::close()}}
    </div>
@stop