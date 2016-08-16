@extends('layout.front')
@section('content')

    @include('layout.notify')
    @if(Session::has('message'))
        <script>
            var notify = document.getElementById('notify');
            notify.classList.add('is-show');
            notify.classList.add('success');
            notify.querySelector('.text-notify').innerText = 'Se ha actualizado los permisos correctamente';
        </script>
    @endif
    <div class="Back-content"><a href="{{ route('roles') }}" class="login-button">Atras</a></div>
    {{Form::model($role, array('route' => array('updateRol', $role->id)))}}
    <div class="wrap-content" style="margin-bottom: 25px">
        {{Form::text('name',$nameRol,['class' => 'Input-title'])}}
    </div>
    <div class="Table-content">

        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($permissionRole as $permission)
                <tr>
                    <td>{{$permission->id}}</td>
                    <td>{{Lang::get('utils.permissions.'.$permission->name)}}</td>
                    <td>
                        {{Form::checkbox('permission[]', $permission->id, 1, ['class' => 'checkbox',])}}
                    </td>
                </tr>
            @endforeach
            @foreach($permissions as $permission)
                <tr>
                    <td>{{$permission->id}}</td>
                    <td>{{Lang::get('utils.permissions.'.$permission->name)}}</td>
                    <td>
                        {{Form::checkbox('permission[]', $permission->id, null, ['class' => 'checkbox',])}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="wrap-content">
        <input type="hidden" id="priority" value="{{$role->priority}}">
        <label for="high">
            Prioridad Alta
            <input type="radio" name="priority" id="high" value="1">
        </label>
        <label for="medium">
            | Prioridad Media
            <input type="radio" name="priority" id="medium" value="2">
        </label>
        <label for="low">
            | Prioridad Baja
            <input type="radio" name="priority" id="low" value="0">
        </label>

    </div>
    <div class="button-update">
        <button class="u-button">Actualizar Rol</button>
    </div>
    {{Form::close()}}
@stop

@section('javascript')
    <script>
        var $priority = $('[name="priority"]');
        for(var i = 0; i < $priority.length; i++){
            if($priority.eq(i).val() == $('#priority').val()){
                $priority.eq(i).attr('checked', true);
                break;
            }
        }
    </script>
@stop