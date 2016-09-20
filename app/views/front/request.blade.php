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
                         @if($user->priority == 0)
                             Baja
                         @elseif($user->priority == 1)
                             Alta
                         @elseif($user->priority == 2)
                             Emp. Credito
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

            @foreach($simpleEnterpricings as $user)
                <tr>
                    <td>{{$user->user_name}}</td>
                    <td>{{$user->identification_card}}</td>
                    <td>
                        Emp. Contado
                    </td>
                    <td> Pendiente por aprobar </td>
                    <td>{{$user->residency_city}}</td>
                    <td>{{$user->email}}</td>
                    <td><a href="#" enable="{{route('admin.activate.user',$user->id)}}" disable="{{route('admin.destroy.user', $user->id)}}" route="{{route('getDataEnterpricing', $user->id)}}" class="icon-folder-open openPopup"></a></td>
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
    <script>
        $('#activeUser, #destroyUser').on('click', function(){

            var r = $(this).attr('id') == 'activeUser'
                ? '¿Estas seguro que deseas aprobar este usuario?'
                : '¿Deseas desaprobar este usuario?';

            if(confirm(r)){
                $.ajax({
                    url : $(this).attr('route'),
                    type : 'GET',
                    success : function(){
                        location.reload();
                    }
                });
            }
            return false;
        });

        $('.openPopup').on('click', function(){

            $.ajax({
                url : $(this).attr('route'),
                type : 'GET',
                data : {
                    enable : $(this).attr('enable'),
                    disable: $(this).attr('disable')
                },
                success : function(data){
                    var user = data.user;
                    var options = $('#options').children();
                    options.eq(0).attr('route', data.routes.enable);
                    options.eq(1).attr('route', data.routes.disable);

                    var html = "";
                    html += "<tr>" +
                                "<th>Nombres</th>" +
                                "<td>" + user.name + " " + user.second_name + " " + user.last_name + " " + user.second_last_name + "</td>" +
                            "</tr>" +
                            "<tr>" +
                                "<th>Email</th>" +
                                "<td>" + user.email + "</td>" +
                            "</tr>" +
                            "<tr>" +
                                "<th>Cedula</th>" +
                                "<td>" + user.identification_card + "</td>" +
                            "</tr>" +
                            "<tr>" +
                                "<th>Celular</th>" +
                                "<td>" + user.mobile_phone + "</td>" +
                            "</tr>" +
                            "<tr>" +
                                "<th>Telefono</th>" +
                                "<td>" + user.mobile_phone + "</td>" +
                            "</tr>" +
                            "<tr>" +
                                "<th>Ciudad de residencia</th>" +
                                "<td>" + user.residency_city + "</td>" +
                            "</tr>" +
                            "<tr>" +
                                "<th>Dirección</th>" +
                                "<td>" + user.address +"</td>" +
                            "</tr>";
                    $('#reload').html(html);
                    $('#DataUser').show();
                }
            });
            return false;
        });
    </script>
@endsection