@extends('layout.front')
@section('content')
    <section class="Credit u-shadow-5">


        <h1>Nuevo usuario</h1>

        {{ Form::open(['route' => 'userNew', 'method' => 'POST', 'class' => 'user-form']) }}


        <section class="Credit-section u-CreditSection">
            <div class="material-input">
                {{Form::text('name','')}}
                {{Form::label('name','Nombre')}}
                <span></span>
            </div>
            <div class="material-input">
                {{Form::text('last_name','')}}
                {{Form::label('last_name','Apellido')}}
                <span></span>
            </div>
            <div class="material-input">
                {{Form::text('user_name','')}}
                {{Form::label('user_name','Username')}}
                <span></span>
            </div>

            <div class="material-input">
                {{ Form::select('location', $location,'',array('class'=>'Credit-select')) }}
                <span></span>
            </div>

        </section>


        <section class="Credit-section">
            <div class="material-input">
                {{Form::text('email','')}}
                {{Form::label('email','E-mail')}}
                <span></span>
            </div>
            <div class="material-input">
                {{Form::text('address','')}}
                {{Form::label('address','Direccion')}}
                <span></span>
            </div>
            <div class="material-input">
                {{Form::text('mobile_phone','')}}
                {{Form::label('mobile_phone','Celular')}}
                <span></span>
            </div>



            <div class="material-input">
                {{ Form::select('roles_id', $roles,'',array('class'=>'Credit-select')) }}
                <span></span>
            </div>

        </section>

        <button class="u-button">
            Enviar Solicitud
        </button>

        {{ Form::close() }}
    </section>
@stop
@section('javascript')<script src="{{asset('js/credit.js')}}"></script> @stop