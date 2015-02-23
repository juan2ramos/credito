@extends('layout/front')

@section('content')
    <figure class="Logo">
        <img class="Logo-img" src="{{asset('img/lilipink.svg')}}" alt="Lilipink"/>
    </figure>
    <div id="slider">
        @for($i=0;$i<count($slidersArrays);$i++)
            @if($slidersArrays[$i]>0)
                <img src="sliders/{{$slidersName[$i]}}" />

            @endif
        @endfor
        @for($i=0;$i<count($slidersArrays);$i++)
            @if($i==0)
                    <span  class="slider sliderValid">0</span>
            @else
                    <span  class="slider ">{{$i}}</span>
            @endif
        @endfor
            <span id="back"><</span>
            <span id="next">></span>

    </div>
@stop

@section('javascript')
        {{ HTML::script('js/slider.js'); }}
@stop
