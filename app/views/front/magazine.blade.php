@extends('layout/front')

@section('content')
    @include('partial.submenu')
    <section class="magazine">
        <iframe width="100%" height="375" src="//e.issuu.com/embed.html#0/38595709" frameborder="0" allowfullscreen></iframe>

        <div class="Buy">
        <a target="_blank" href="{{url('img/emprendedoras.pdf')}}">DESCARGAR CATÁLAGO</a>
        </div>
    </section>

@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop
