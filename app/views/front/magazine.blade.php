@extends('layout/front')

@section('content')
    @include('partial.submenu')
    <section class="magazine">
        <iframe width="100%" height="375" src="//e.issuu.com/embed.html#0/37559411" frameborder="0" allowfullscreen></iframe>
    </section>
@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop
