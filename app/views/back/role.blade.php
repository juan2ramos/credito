@extends('layout.front')
@section('content')

    <h1>{{Lang::get('utils.roles.' . $role->name)}}</h1>
    <div class="Table-content">
        {{Form::open(array('route'=>'rolUpdate','method'=>'POST'))}}
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
                    <td>{{$permission->name}}</td>
                    <td>
                        {{Form::checkbox('permission[]', $permission, null, ['class' => 'checkbox',])}}
                    </td>
                </tr>
            @endforeach
            @foreach($permissions as $permission)
                <tr>
                    <td>{{$permission->id}}</td>
                    <td>{{Lang::get('utils.permissions.'.$permission->name)}}</td>
                    <td>
                        {{Form::checkbox('permission[]', $permission, null, ['class' => 'checkbox',])}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="button-update">
        <button class="u-button">Cambiar Permisos</button>
    </div>
@stop