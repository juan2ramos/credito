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
            @foreach($showRequest as $credit)
                @foreach($showRequest as $user)
                    @if($user->id==$credit->CreditRequest["user_id"])
                        @if($credit->CreditRequest["priority"]==1)
                            <tr style="background: rgba(223, 130, 130, 0.21)">
                                <td>{{$credit->user_name}}</td>
                                <td>{{$credit->identification_card}}</td>
                                <td>
                                    @if($credit->CreditRequest["priority"]==1)
                                        Alta
                                    @else
                                        Baja
                                    @endif
                                </td>
                                <td>Pendiente por aprobar</td>
                                <td>
                                    @foreach($locations as $location)
                                        @if($credit->CreditRequest["location"]==$location->id)
                                            {{$location->name}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$credit->email}}</td>
                                <td>{{ HTML::link(URL::to('showCreditRequest/'.$credit->id), '',array('class'=>'icon-folder-open')) }}</td>
                            </tr>
                        @endif
                    @endif
                @endforeach
            @endforeach
            @foreach($showRequest as $credit)
                @foreach($showRequest as $user)
                    @if($user->id==$credit->CreditRequest["user_id"])
                        @if($credit->CreditRequest["priority"]==0)
                            <tr>
                                <td>{{$credit->user_name}}</td>
                                <td>{{$credit->identification_card}}</td>
                                <td>
                                    @if($credit->CreditRequest["priority"]==1)
                                        Alta
                                    @else
                                        Baja
                                    @endif
                                </td>
                                <td>Pendiente por aprobar</td>
                                <td>
                                    @foreach($locations as $location)
                                        @if($credit->CreditRequest["location"]==$location->id)
                                            {{$location->name}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$credit->email}}</td>
                                <td>{{ HTML::link(URL::to('showCreditRequest/'.$credit->id), '',array('class'=>'icon-folder-open')) }}</td>
                            </tr>
                        @endif
                    @endif
                @endforeach
            @endforeach

            </tbody>
        </table>
    </div>
@stop
