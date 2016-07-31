@extends('layout/front')

@section('content')
    @include('partial.submenu')
    <a href="{{route('isEnterprising')}}"><img src="{{asset('img/emprendedoras-slide.png')}}" alt=""></a>
@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop
