@extends('layout.front')
@section('content')

    <h1>Roles</h1>
    <div class="Table-content">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Ver permisos</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{Lang::get('utils.roles.'.$role->name)}}</td>
                    <td>
                        <a href="{{route('rol', $role->id)}}" class="icon-folder-open"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop