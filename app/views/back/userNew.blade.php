@extends('layout.front')
@section('content')
    <section class="Credit u-shadow-5">


        <h1>Nuevo usuario</h1>

        {{ Form::open(['route' => 'userNew', 'method' => 'POST', 'class' => 'user-form']) }}


        <section class="Credit-section u-CreditSection">
            <div class="material-input">
                {{Form::text('identification_card','',['id' => 'identification_card'])}}
                {{Form::label('identification_card','Cedula')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('name','',['id' => 'name'])}}
                {{Form::label('name','Nombre')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('second_name','',['id' => 'second_name'])}}
                {{Form::label('second_name','Segundo nombre')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('last_name','',['id' => 'last_name'])}}
                {{Form::label('last_name','Apellido')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('second_last_name','',['id' => 'second_last_name'])}}
                {{Form::label('second_last_name','Segundo apellido')}}
                <span></span>
            </div>

        </section>

        <section class="Credit-section">

            <div class="material-input">
                {{Form::text('name','',['id' => 'email'])}}
                {{Form::label('email','E-Mail')}}
                <input id="date_birth" name="date_birth" type="date" value="">
                <label for="date_birth">Fecha de nacimiento</label>
                <span></span>
            </div>

        </section>

        <button class="u-button">
            Enviar Solicitud
        </button>

        {{ Form::close() }}
    </section>
@stop