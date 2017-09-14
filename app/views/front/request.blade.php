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
                <th>Punto</th>
                <th>Revisar</th>
            </tr>
            </thead>
            <tbody>

            @foreach($showRequest as $user)
                 <tr>
                     <td>{{$user->user_name}}</td>
                     <td>{{$user->identification_card}}</td>
                     <td>
                         @if($user->priority == 0)
                             Baja
                         @elseif($user->priority == 1)
                             Alta
                         @elseif($user->priority == 2)
                             Emp. Credito
                         @endif
                     </td>
                     <td> Pendiente por aprobar </td>
                     <td style="text-transform: capitalize;">
                         @foreach($locations as $location)
                             @if($user->location==$location->id)
                                 {{$location->name}}
                             @endif
                         @endforeach
                     </td>
                     <td>{{$user->pointname}}</td>
                     <td><a href="{{route('showCreditRequest', $user->id)}}" class="icon-folder-open"></a></td>

                 </tr>
            @endforeach

            @foreach($simpleEnterpricings as $user)
                <tr>
                    <td>{{$user->user_name}}</td>
                    <td>{{$user->identification_card}}</td>
                    <td>
                        Emp. Contado
                    </td>
                    <td> Pendiente por aprobar </td>
                    <td style="text-transform: capitalize;">{{$user->residency_city}}</td>

                    <td>{{$user->pointname}}</td>
                    <td><a href="#" type="user" enable="{{route('admin.activate.user',$user->id)}}" disable="{{route('admin.destroy.user', $user->id)}}" route="{{route('getDataEnterpricing', $user->id)}}" class="icon-folder-open openPopup"></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <section id="DataUser" class="Popup" style="display: none">
        <article class="Popup-window">
            <span class="close"></span>
            <table id="reload"></table>
            <div class="options" id="options">
                <a href='#' route='' class='Button' id='activeUser'>Aprobar</a>
                <a href='#' route='' class='Button' id='destroyUser'>Desaprobar</a>
            </div>
        </article>
    </section>
@stop

@section('javascript')
    <script src="{{asset('js/user-list.js')}}"></script>
@endsection