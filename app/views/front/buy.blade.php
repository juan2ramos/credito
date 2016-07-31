@extends('layout/front')

@section('content')
    @include('partial.submenu')
    <section class="Buy">
        <article class="tienda" >
            <img src="{{asset('img/tiendas.png')}}" alt="">
            <ul>
                <li><span class="point"><img src="{{asset('img/point.png')}}" alt=""></span> Tendrás acceso a todo el portafolio de productos que estén en la tienda emprendedora no solamente los que se encuentren publicados en el magazine</li>
                <li><span class="point"><img src="{{asset('img/point.png')}}" alt=""></span>Antes de facturar indica que eres una EMPRENDEDORA LILIPINK y presenta tu cédula en el punto de pago</li>
            </ul>
            <a href="">LISTADO TIENDAS EMPRENDEDORAS</a>
        </article>
        <article>
            <img class="pedidos" src="{{asset('img/pedidos.png')}}" alt="">
            <ul>
                <li><span class="point"><img src="{{asset('img/point.png')}}" alt=""></span>Podrás montar en línea el pedido de los productos del magazine vigente</li>
                <li><span class="point"><img src="{{asset('img/point.png')}}" alt=""></span>Tu pedido será enviado una vez se registre el pago, el tiempo estimado de respuesta es de 3 días bogotá y 6 días a nivel <nacional></nacional></li>
            </ul>
            <a href="">INSTRUCTIVO PEDIDO EN LINEA</a>
        </article>
    </section>
@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop
