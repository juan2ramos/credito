@extends('layout/front')
@section('title') Contenidos @stop
@section('content')

    <section class="Slider u-shadow-5">
        <div class="slider-content">
            <p class="slider-nuw" onclick="nuevo();">nuevo</p>
            <p class="slider-edit" onclick="editar();">editar</p>
        </div>

        <section id="slider-new" class="hidden">
            <h1>Sliders</h1>

            {{Form::open(array('route'=>'slider','method'=>'POST','files'=>true,'class'=>"Slider-form",'enctype'=>'multipar/form-data'))}}

            <div class="hidden">
                {{Form::text('number_slider','',['id' => 'number_slider'])}}
            </div>

            <div class="pop-up ">
                <p>Sube tu imagen</p>
                {{ HTML::image('img/image-file.svg','', array ('id' => 'image-file')) }}
                {{Form::file('files',array('id'=>'files','name'=>'files'))}}
            </div>

            <div id="request-image" > </div>

            <button class="u-button">
                Guardar Sliders
            </button>

            {{Form::close()}}
        </section>
        <section  id="slider-edit">
            {{ Form::open(array('name'=>'slider-form','route' => 'administratorSlider', 'method' => 'POST','class'=>'form-slider')) }}
            <div class="hidden">{{$i=0;}}</div>
            @if(count($sliders))
                @foreach($sliders as $slider)
                    <section>
                        <img src="sliders/{{$slider->files}}" />
                        {{ Form::select("$i", $select, $slider->number_slider, array('class' => 'number_slider')) }}
                        <div class="hidden">{{$i++;}}</div>
                    </section>
                @endforeach
            @endif
            <button class="u-button">
                Guardar Sliders
            </button>
            {{Form::close()}}
        </section>

    </section>

@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop