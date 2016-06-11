@extends('layout/front')
@section('title') Contenidos @stop
@section('content')

    <section class="Slider u-shadow-5">
        <div class="slider-content">
            <p class="slider-new" onclick="nuevo();">nuevo</p>
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
            {{ Form::open(['name'=>'slider-form','route' => 'administratorSlider', 'method' => 'POST','class'=>'form-slider']) }}

            @if(count($sliders))
                @foreach($sliders as $key => $slider)
                    <section>
                        <img src="{{url('sliders/' . $slider->files)}}" >
                        <span class="close-button-slider">
                            <span class="close-line-slider"></span>
                            <span class="close-line1-slider"></span>
                        </span>
                        <a href="{{route('deleteSlider', $slider->id)}}" id="slider-delete">del</a>
                        <div class="hidden">{{$key}}</div>
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