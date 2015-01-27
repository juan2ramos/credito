@extends('layout.front')
@section('content')

    <div class="Table-content">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <td>
                        <a href="{{route('rol', $role->id)}}" class="icon-folder-open"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop