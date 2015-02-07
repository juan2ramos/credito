@extends('layout/front')
@section('title') Contenidos @stop
@section('content')

            <p>{{$errors->first('password')}}</p>
            <p>{{$errors->first('confirmar_password')}}</p>



    <section class="Slider u-shadow-5">
        <h1>Restaurar Contraseña</h1>
            {{ Form::open(array('url' => 'restaurar/'.$user['id'],'class'=>'Credito-form')) }}
            <div class="material-input">
                {{Form::password('password','',['id' => 'password'])}}
                {{Form::label('password','Password')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::password('confirmar_password','',['id' => 'confirmar_password'])}}
                {{Form::label('confirmar_password','Confirmar Password')}}
                <span></span>
            </div>

            <button class="u-button">
                Enviar Solicitud
            </button>

            {{ Form::close() }}



    </section>

@stop
@section('javascript')
    {{ HTML::script('js/credit.js'); }}
@stop