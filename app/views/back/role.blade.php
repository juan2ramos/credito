@extends('layout.front')
@section('content')

    <h1>{{Lang::get('utils.roles.' . $role->name)}}</h1>
    <div class="Table-content">
        {{Form::model($role, array('route' => array('updateRol', $role->id)))}}

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
    <div class="button-update">
        <button class="u-button">Cambiar Permisos</button>
    </div>
    {{Form::close()}}
@stop