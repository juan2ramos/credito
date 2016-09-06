@extends('layout/front')

@section('content')
    @include('partial.submenu')
    <section class="magazine">
        <iframe width="100%" height="375" src="//e.issuu.com/embed.html#0/38557685" frameborder="0" allowfullscreen></iframe>

        <div class="Buy">
        <a target="_blank" href="{{url('img/emprendedoraslilipink.pdf')}}">Descargar catálogo</a>
        </div>
    </section>

@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop
