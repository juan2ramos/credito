@extends('layout/front')

@section('content')
    @include('partial.submenu')
    <a href="{{route('isEnterprising')}}"><img src="{{asset('img/principalEmprendedoras.jpg')}}" alt=""></a>
@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop
