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

            @foreach($showRequest as $user)
                 <tr>
                     <td>{{$user->user_name}}</td>
                     <td>{{$user->identification_card}}</td>
                     <td>
                         @if($user->priority == 1)
                             Alta
                         @elseif($user->priority == 2)
                             Media
                         @else
                             Baja
                         @endif
                     </td>
                     <td> Pendiente por aprobar </td>
                     <td>
                         @foreach($locations as $location)
                             @if($user->location==$location->id)
                                 {{$location->name}}
                             @endif
                         @endforeach
                     </td>
                     <td>{{$user->email}}</td>
                     <td><a href="{{route('showCreditRequest', $user->id)}}" class="icon-folder-open"></a></td>
                 </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop