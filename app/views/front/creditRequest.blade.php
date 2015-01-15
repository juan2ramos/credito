@extends('layout/front')
@section('title') Solicitud de Credito @stop
@section('content')

    <section class="Login u-shadow-5">
        <h1>Solicitud de credito</h1>


        {{Form::open(array('url'=>'credito','method'=>'POST','file'=>true))}}

        {{Form::text('cedula','',array('placeholder'=>'Cedula'))}}
        {{Form::text('ciudad_residencia','',array('placeholder'=>'Ciudad de residencia'))}}
        {{Form::text('fecha_expedicion','',array('placeholder'=>'Fecha de expedicion'))}}
        {{Form::text('fecha_nacimiento','',array('placeholder'=>'Fecha de nacimiento'))}}
        {{Form::text('lugar_expedicion','',array('placeholder'=>'Lugar de expedicion'))}}
        {{Form::text('celular','',array('placeholder'=>'Celular'))}}
        {{Form::text('telefono','',array('placeholder'=>'Telefono'))}}
        {{Form::text('direccion','',array('placeholder'=>'Direccion'))}}
        {{Form::text('direccion_oficina','',array('placeholder'=>'Direccion de la oficina'))}}
        {{ Form::select('tipo_documento', $tipo) }}
        {{Form::text('referencia','',array('placeholder'=>'Referenccia'))}}
        {{Form::text('valor_mensual','',array('placeholder'=>'Valor mensual'))}}
        {{Form::file('archivo',array('id'=>'files'))}}
        <div class="imagen"></div>
        <button class="u-button">
            Enviar Solicitud
        </button>

        {{Form::close()}}
    </section>

@stop

@section('javascript')
    {{ HTML::script('js/credit.js'); }}
@stop