@extends('layout/front')

@section('content')
    @include('partial.submenu')
    <section class="Buy">
        <article class="tienda" >
            <img src="{{asset('img/tiendas.png')}}" alt="">
            <ul>
                <li><span class="point"><img src="{{asset('img/point.png')}}" alt=""> </span><b>CONTADO: </b> Antes de facturar indica que eres una EMPRENDEDORA LILI PINK y presenta tu cédula</li>
                <li><span class="point"><img src="{{asset('img/point.png')}}" alt=""> </span><b>CRÉDITO EMPRENDEDORA: </b>Si llenaste el formulario para crédito emprendedora y te fue aprobado un cupo, presenta tu tarjeta, cédula e indica que eres una EMPRENDEDORA LILI PINK, recuerda que el pago lo debes hacer en nuestras  tiendas a una (1) cuota</li>
            </ul>
        </article>
        <article>
            <img class="pedidos" src="{{asset('img/pedidos.png')}}" alt="">
            <ul>
                <li><span class="point"><img src="{{asset('img/point.png')}}" alt=""> </span>Los pagos los puedes hacer en: <br>
                    <span style="color: #BA007C">* BANCOLOMBIA:</span><br>
                    Formato recaudo empresarial<br>
                    a nombre de Innova Quality S.A.S.<br>
                    Cuenta de ahorros 16862920931<br>
                     <span style="color: #BA007C">* EFECTY</span><br>
                    Convenio 110064<br>
                </li>
            </ul>
        </article>
    </section>
@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop
