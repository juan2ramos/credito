@extends('layout/front')

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
                @if($request["credit"]->state<1)
                    @if($request["credit"]->priority==1)
                        <tr style="background: rgba(223, 130, 130, 0.21)">
                            <td>{{$request["user"]->user_name}}</td>
                            <td>{{$request["user"]->identification_card}}</td>
                            <td>alta</td>
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
                @endif
            @endforeach
            @foreach($showRequest as $request)
                @if($request["credit"]->state<1)
                    @if($request["credit"]->priority==0)
                        <tr>
                            <td>{{$request["user"]->user_name}}</td>
                            <td>{{$request["user"]->identification_card}}</td>
                            <td>baja</td>
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
                @endif
            @endforeach

            </tbody>
        </table>
    </div>
@stop
