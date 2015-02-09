@extends('layout/front')

@section('content')
    <section class="Credit u-shadow-5">
    </section>
    <div class="Table-content">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>Usuario</th>
                <th>Cedula</th>
                <th>Prioridad</th>
                <th>Estado</th>
                <th>Leido</th>
                <th>E-mail</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($showRequest as $request)
                @if($request["credit"]->priority==1)
                <tr>
                    <td>{{$request["user"]->user_name}}</td>
                    <td>{{$request["user"]->identification_card}}</td>
                    <td>{{$request["credit"]->priority}}</td>
                    <td>
                        @if($request["credit"]->state)
                            Aprobado
                        @else
                            Pendiente
                        @endif
                    </td>
                    <td>
                        @if($request["credit"]->notify==0)
                            No visto
                        @else
                            Visto
                        @endif
                    </td>
                    <td>{{$request["user"]->email}}</td>
                </tr>
                @endif
            @endforeach
            @foreach ($showRequest as $request)
                @if($request["credit"]->priority==0)
                <tr>
                    <td>{{$request["user"]->user_name}}</td>
                    <td>{{$request["user"]->identification_card}}</td>
                    <td>{{$request["credit"]->priority}}</td>
                    <td>
                        @if($request["credit"]->state)
                            Aprobado
                        @else
                            Pendiente
                        @endif
                    </td>
                    <td>
                        @if($request["credit"]->notify==0)
                            No visto
                        @else
                            Visto
                        @endif
                    </td>
                    <td>{{$request["user"]->email}}</td>
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
@stop
