@extends('layout/front')
@section('title') Contenidos @stop
@section('content')

    <section class="Slider u-shadow-5">
        <!--<div class="slider-content">
            <p class="slider-new" onclick="nuevo();">nueva region</p>
            <p class="slider-edit" onclick="editar();">editar</p>
        </div>

        <section id="slider-new" class="hidden">
            <h1>Regiones</h1>

        </section>
        <section  id="slider-edit">

        </section>-->

    </section>

@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop