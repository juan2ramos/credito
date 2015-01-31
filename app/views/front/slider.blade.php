@extends('layout/front')
@section('title') Contenidos @stop
@section('content')

    <section class="Slider u-shadow-5">
        <h1>Sliders</h1>

        {{Form::open(array('url'=>'slider','method'=>'POST','files'=>true,'class'=>"Slider-form",'enctype'=>'multipar/form-data'))}}

        <div class="material-input">
            {{Form::text('number_slider','',['id' => 'number_slider'])}}
            {{Form::label('number_slider','número de imagenes')}}
            <span></span>
        </div>

        <div class="hidden">
            {{Form::text('files','',['id'=>'form-files'])}}
        </div>

        <div class="pop-up ">
            <p>Sube <tus></tus> documentos</p>
            {{ HTML::image('img/image-file.svg','', array ('id' => 'image-file')) }}
            {{Form::file('file[]',array('id'=>'files','name'=>'file[]','multiple'))}}
        </div>

        <div class="request-image" > </div>

        <button class="u-button">
            Guardar Sliders
        </button>

        {{Form::close()}}
    </section>

@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop