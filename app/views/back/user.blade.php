@extends('layout.front')
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
    @if($errors->first())
        <script>
            var notify = document.getElementById('notify');
            notify.classList.add('is-show');
            notify.classList.add('error');
            notify.querySelector('.text-notify').innerText = 'Los datos estan incorrectos {{$errors->first('email')}}  ';
        </script>
    @endif

    <div class="Back-content">
        {{ HTML::link(URL::to('admin/usuarios'), 'atras',array('class'=>'login-button')) }}
    </div>

    <h1>Datos del usuario</h1>

    <div class="Table-content">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>Cedula</th>
                <th>Primer Nombre</th>
                <th>Segundo Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
                <th>User Name</th>
                <th>E-mail</th>
                <th>Direccion</th>
                <th>Ciudad de recidencia</th>
                <th>Ciudad de nacimiento</th>
                <th>Movil</th>
                <th>Celular</th>
                <th>Fecha de nacimiento</th>
                <th>Region</th>

            </tr>
            </thead>
            <tbody>
                <tr>
                    {{Form::open(array('url'=>'admin/uploadUser/'.$user->id,'method'=>'POST','class'=>"variables"))}}
                    {{form::text('id', $user->id,array('class'=>'hidden'))}}
                    <td class="variable"><p class="p1">{{$user->identification_card}}</p>{{form::text('identification_card', $user->identification_card,array('class'=>'hidden variableText1'))}}</td>
                    <td class="variable"><p class="p1">{{$user->name}}</p>{{form::text('name', $user->name ,array('class'=>'hidden variableText1'))}}</td>
                    <td class="variable"><p class="p1">{{$user->second_name}}</p>{{form::text('second_name', $user->second_name ,array('class'=>'hidden variableText1'))}}</td>
                    <td class="variable"><p class="p1">{{$user->last_name}}</p>{{form::text('last_name', $user->last_name ,array('class'=>'hidden variableText1'))}}</td>
                    <td class="variable"><p class="p1">{{$user->second_last_name}}</p>{{form::text('second_last_name', $user->second_last_name ,array('class'=>'hidden variableText1'))}}</td>
                    <td class="variable"><p class="p1">{{$user->user_name}}</p>{{form::text('user_name', $user->user_name ,array('class'=>'hidden variableText1'))}}</td>
                    <td class="variable"><p class="p1">{{$user->email}}</p>{{form::text('email', $user->email ,array('class'=>'hidden variableText1'))}}</td>
                    <td class="variable"><p class="p1">{{$user->address}}</p>{{form::text('address', $user->address ,array('class'=>'hidden variableText1'))}}</td>
                    <td class="variable"><p class="p1">{{$user->residency_city}}</p>{{form::text('residency_city', $user->residency_city ,array('class'=>'hidden variableText1'))}}</td>
                    <td class="variable"><p class="p1">{{$user->birth_city}}</p>{{form::text('birth_city', $user->birth_city ,array('class'=>'hidden variableText1'))}}</td>
                    <td class="variable"><p class="p1">{{$user->mobile_phone}}</p>{{form::text('mobile_phone', $user->mobile_phone ,array('class'=>'hidden variableText1'))}}</td>
                    <td class="variable"><p class="p1">{{$user->phone}}</p>{{form::text('phone', $user->phone ,array('class'=>'hidden variableText1'))}}</td>
                    <td class="variable"><p class="p1">{{$user->date_birth}}</p>{{Form::input('date','date_birth',$user->date_birth,['class'=>'hidden variableText1'])}}</td>
                    <td class="variable"><p class="p1">{{$location}}</p>{{ Form::select('location', $locations,$user->location,array('class'=>'hidden variableText1')) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <button class="u-button">
        Actualizar usuario
    </button>
    {{form::close()}}

    <h2>Creditos a cargo</h2>


            @if($credits)
                @foreach($credits as $credit)
                    @if($credit->responsible==$user->id)
                        <details>
                            <summary><h2>Creditos</h2></summary>
                            <p>Estado: {{$credit->state}}</p>
                            <p>Prioridad: {{$credit->priority}}</p>
                            <p>Egresos Mensuales: {{$credit->monthly_expenses}}</p>
                            <p>Ingresos Mensuales: {{$credit->monthly_income}}</p>
                            <p>Direccion de la oficina: {{$credit->office_address}}</p>
                            <p>Lugar de expedicion: {{$credit->instead_expedition}}</p>
                            <p>Fecha de expedicion: {{$credit->date_expedition}}</p>
                            <h3>Referencia 1</h3>
                            <p>Nombre: {{$credit->name_reference}}</p>
                            <p>Telefono: {{$credit->phone_reference}}</p>
                            <h3>Referencia 2</h3>
                            <p>Nombre: {{$credit->name_reference}}</p>
                            <p>Telefono: {{$credit->phone_reference}}</p>

                        </details>
                    @endif
                @endforeach
            @endif


@stop

@section('javascript')
    {{ HTML::script('js/variables.js'); }}
@stop