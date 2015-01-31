@extends('layout/front')

@section('content')
    <figure class="Logo">
        <img class="Logo-img" src="{{asset('img/lilipink.svg')}}" alt="Lilipink"/>
    </figure>

    <div id="slider">
        <img src="img/slider0.jpg">
        <img src="img/slider1.jpg">
        <img src="img/slider2.jpg">
        <img src="img/slider3.jpg">
        <span id="back"><</span>
        <span id="next">></span>
        <span  class="slider sliderValid">0</span>
        <span  class="slider ">1</span>
        <span  class="slider ">2</span>
        <span  class="slider ">3</span>
    </div>
@stop

@section('javascript')
        {{ HTML::script('js/slider.js'); }}
@stop
