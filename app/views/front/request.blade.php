@extends('layout/front')

@section('content')
    <h1>Solicitud de creditos pendientes</h1>
    <div class="Table-content">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>Usuario</th>
                <th>Cedula</th>
                <th>Prioridad</th>
                <th>Estado</th>
                <th>Region</th>
                <th>E-mail</th>
                <th>Revisar</th>
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
                            Pendiente por aprobacion
                        @endif
                    </td>
                    <td>
                        @foreach($locations as $location)
                            @if($request["credit"]->location==$location->id)
                                {{$location->name}}
                            @endif
                        @endforeach
                    </td>
                    <td>{{$request["user"]->email}}</td>
                    <td>{{ HTML::link(URL::to('showCreditRequest/'.$request["user"]->id), '',array('class'=>'icon-folder-open')) }}</td>
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
                        @foreach($locations as $location)
                            @if($request["credit"]->location==$location->id)
                                {{$location->name}}
                            @endif
                        @endforeach
                    </td>
                    <td>{{$request["user"]->email}}</td>
                    <td>{{ HTML::link(URL::to('showCreditRequest/'.$request["user"]->id), '',array('class'=>'icon-folder-open')) }}</td>
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
@stop
