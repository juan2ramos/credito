@extends('layout/front')
@section('title') Solicitud de Credito @stop
@section('content')

    <section class="Credito u-shadow-5">

        <h1>Solicitud de credito</h1>

        {{Form::open(array('url'=>'credito','method'=>'POST','file'=>true,'class'=>"Credito-form"))}}


        <section class="Credit-section u-CreditSection">
            <div class="material-input">
                {{ Form::select('tipo_documento', $tipo,'',array('class'=>'Credit-select')) }}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('cedula','',['id' => 'cedula','required'])}}
                {{Form::label('cedula','Cedula')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('ciudad_residencia','',['id' => 'ciudad_residencia','required'])}}
                {{Form::label('ciudad_residencia','Ciudad de residencia')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('ciudad_residencia','',['id' => 'ciudad_residencia','required'])}}
                {{Form::label('ciudad_residencia','Ciudad de residencia')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('fecha_expedicion','',['id' => 'fecha_expedicion','required'])}}
                {{Form::label('fecha_texpedicion','Fecha de expedicion')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('fecha_nacimiento','',['id' => 'fecha_nacimiento','required'])}}
                {{Form::label('fecha_nacimiento','Fecha de nacimiento')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('lugar_expedicion','',['id' => 'lugar_expedicion','required'])}}
                {{Form::label('lugar_expedicion','Lugar de expedicion')}}
                <span></span>
            </div>

        </section>

        <section class="Credit-section">

            <div class="material-input">
                {{Form::text('celular','',['id' => 'celular','required'])}}
                {{Form::label('celular','Celular')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('telefono','',['id' => 'telefono','required'])}}
                {{Form::label('telefono','Telefono')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('direccion','',['id' => 'direccion','required'])}}
                {{Form::label('direccion','Direccion')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('direccion_oficina','',['id' => 'direccion_oficina','required'])}}
                {{Form::label('direccion_oficina','Direcion de la oficina')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('referencia','',['id' => 'referencia','required'])}}
                {{Form::label('referencia','Referencia')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('valor_mensual','',['id' => 'valor_mensual','required'])}}
                {{Form::label('valor_mensual','Valor mensual')}}
                <span></span>
            </div>

        </section>

        <div class="pop-up ">
            <p>Sube <tus></tus> documentos</p>
            {{ HTML::image('img/image-file.svg','', array ('id' => 'image-file')) }}
            {{Form::file('archivo',array('id'=>'files','class'=>'','multiple'))}}
        </div>


        <div class="request-image">
        </div>


        <label class="label--checkbox">
            {{Form::checkbox('remember', 1, null, ['class' => 'checkbox'])}}
            Acepto las condiciones de lilipink
        </label>

        <button class="u-button">
            Enviar Solicitud
        </button>

        {{Form::close()}}
    </section>

@stop

@section('javascript')
    {{ HTML::script('js/credit.js'); }}
@stop