@extends('layout.front')
@section('content')


    <h1>{{$role->name}}</h1>
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
                    <td>{{$permission->name}}</td>
                    <td>
                        <a href="" class="icon-trash-empty "></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop