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
    @if($errors->first() or Session::get('message_error'))
        <script>
            var notify = document.getElementById('notify');
            notify.classList.add('is-show');
            notify.classList.add('error');
            @if( Session::get('message_error'))
            notify.querySelector('.text-notify').innerText = '{{Session::get('message_error')}}';
            @endif
            notify.querySelector('.text-notify').innerText = 'Los datos estan incorrectos {{$errors->first('identification_card')}} {{$errors->first('email')}}{{$errors->first('name')}} {{Session::get('message_error')}}';
        </script>
    @endif

    <div class="Back-content">
        {{ HTML::link(URL::to('admin/usuarios'), 'atras',array('class'=>'login-button')) }}
    </div>




    <section class="Credit u-shadow-5">

        <h1>Datos del usuario</h1>
        @if(Auth::user()->roles_id==4)
            {{Form::open(array('url'=>'Actualizar/'.$user->id,'method'=>'POST','class'=>"User-form",'files'=>true))}}
        @else
            {{Form::open(array('url'=>'admin/uploadUser/'.$user->id,'method'=>'POST','class'=>"User-form",'files'=>true))}}
        @endif
        @if(Auth::user()->roles_id==1)
            @if($user->roles_id==4)
                <div class="material-input">
                    {{form::text('card', $user->card ,array('class'=>' variableText1'))}}
                    {{Form::label('card','Tarjeta ')}}
                    <span></span>
                </div>
            @endif
        @endif

        <section class="Credit-section ">

            {{form::text('id', $user->id,array('class'=>'hidden'))}}


            <div class="material-input">
                {{form::text('name', $user->name ,array('class'=>' variableText1'))}}
                {{Form::label('name','Nombre')}}
                <span></span>
            </div>

            <div class="material-input">
                {{form::text('identification_card', $user->identification_card,array('class'=>' variableText1'))}}
                {{Form::label('identification_card','Cedula')}}
                <span></span>
            </div>

            <div class="material-input">
                {{form::text('name', $user->name ,array('class'=>' variableText1'))}}
                {{Form::label('name','Nombre')}}
                <span></span>
            </div>

            <div class="material-input">
                {{form::text('second_name', $user->second_name ,array('class'=>' variableText1'))}}
                {{Form::label('second_name','Segundo nombre')}}
                <span></span>
            </div>

            <div class="material-input">
                {{form::text('last_name', $user->last_name ,array('class'=>' variableText1'))}}
                {{Form::label('last_name','Apellido')}}
                <span></span>
            </div>

            <div class="material-input">
                {{form::text('second_last_name', $user->second_last_name ,array('class'=>' variableText1'))}}
                {{Form::label('second_last_name','Segundo apellido')}}
                <span></span>
            </div>

            <div class="material-input">
                {{form::text('user_name', $user->user_name ,array('class'=>' variableText1'))}}
                {{Form::label('user_name','Username')}}
                <span></span>
            </div>

            <div class="material-input">
                {{form::text('email', $user->email ,array('class'=>'variableText1'))}}
                {{Form::label('email','E-mail')}}
                <span></span>
            </div>

        </section>

        <section class="Credit-section u-CreditSection">

            <div class="material-input">
                {{form::text('address', $user->address ,array('class'=>' variableText1'))}}
                {{Form::label('address','Direccion')}}
                <span></span>
            </div>

            <div class="material-input">
                {{form::text('residency_city', $user->residency_city ,array('class'=>' variableText1'))}}
                {{Form::label('residency_city','Ciudad de residencia')}}
                <span></span>
            </div>

            <div class="material-input">
                {{form::text('birth_city', $user->birth_city ,array('class'=>' variableText1'))}}
                {{Form::label('birth_city','Ciudad de nacimiento')}}
                <span></span>
            </div>

            <div class="material-input">
                {{form::text('mobile_phone', $user->mobile_phone ,array('class'=>' variableText1'))}}
                {{Form::label('mobile_phone','Celular')}}
                <span></span>
            </div>

            <div class="material-input">
                {{form::text('phone', $user->phone ,array('class'=>' variableText1'))}}
                {{Form::label('phone','telefono')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::input('date','date_birth',$user->date_birth,['class'=>' variableText1','id' => 'date_birth'])}}
                {{Form::label('date_birth','fecha de nacimiento')}}
                <span></span>
            </div>

            <div class="material-input">
                {{ Form::select('location', $locations,$user->location,array('class'=>'Credit-select')) }}
                <span></span>
            </div>

        </section>

        <div class="material">
            {{Form::label('photo','Foto')}}
            {{Form::file('photo',['id'=>'photo'])}}
        </div>

        <button class="u-button">
            Actualizar datos
        </button>

        {{form::close()}}

    </section>
            @if(isset($credits[0]))
                        <details>
                            <summary><h2>Credito solicitado</h2></summary>
                            <p>Estado: {{$credits[0]->state}}</p>
                            <p>Prioridad: {{$credits[0]->priority}}</p>
                            <p>Egresos Mensuales: {{$credits[0]->monthly_expenses}}</p>
                            <p>Ingresos Mensuales: {{$credits[0]->monthly_income}}</p>
                            <p>Direccion de la oficina: {{$credits[0]->office_address}}</p>
                            <p>Lugar de expedicion: {{$credits[0]->instead_expedition}}</p>
                            <p>Fecha de expedicion: {{$credits[0]->date_expedition}}</p>
                            <h3>Referencia 1</h3>
                            <p>Nombre: {{$credits[0]->name_reference}}</p>
                            <p>Telefono: {{$credits[0]->phone_reference}}</p>
                            <h3>Referencia 2</h3>
                            <p>Nombre: {{$credits[0]->name_reference}}</p>
                            <p>Telefono: {{$credits[0]->phone_reference}}</p>

                        </details>
            @endif


@stop

@section('javascript')
    {{ HTML::script('js/variables.js'); }}
    {{ HTML::script('js/credit.js'); }}
@stop