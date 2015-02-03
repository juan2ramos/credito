@extends('layout/front')
@section('title') Contenidos @stop
@section('content')

    <section class="Slider u-shadow-5">
        <button class=""></button>
        <h1>Sliders</h1>
        {{ Form::open(array('name'=>'slider-form','route' => 'administratorSlider', 'method' => 'POST','class'=>'form-slider')) }}
        <div class="hidden">{{$i=0;}}</div>
        @if(count($sliders))
            @foreach($sliders as $slider)
                <section>
                    <img src="sliders/{{$slider->files}}" />
                    {{ Form::select("$i", $select, null, array('class' => 'number_slider')) }}
                    <div class="hidden">{{$i++;}}</div>
                </section>
            @endforeach
        @endif
        <button class="u-button">
            Guardar Sliders
        </button>
        {{Form::close()}}
    </section>

@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop