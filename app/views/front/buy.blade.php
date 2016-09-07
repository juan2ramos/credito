@extends('layout/front')

@section('content')
    @include('partial.submenu')
    <section class="Buy">
        <article class="tienda" >
            <img src="{{asset('img/tiendas.png')}}" alt="">
            <ul>
                <li><span class="point"><img src="{{asset('img/point.png')}}" alt=""></span>
                    Tendrás acceso a todo el portafolio

                    de productos que estén en la tienda

                    emprendedora -no solamente los

                    que se encuentren publicados en

                    el catálogo-
                </li>
                <li><span class="point"><img src="{{asset('img/point.png')}}" alt=""></span>
                    Antes de facturar indica que eres una

                    EMPRENDEDORA LILIPINK y presenta tu

                    cédula en el punto de pago
                </li>
                <li>
                    <span class="point"><img src="{{asset('img/point.png')}}" alt=""></span>
                    Recuerda que para acceder al 25% de descuento tus compras mínimas deben ser de $300.000
                </li>
            </ul>
            <a target="_blank" href="{{url('img/tiendasemprendedoras.pdf')}}">LISTADO TIENDAS EMPRENDEDORAS</a>
        </article>
        <article>
            <img class="pedidos" src="{{asset('img/pedidos.png')}}" alt="">
            <ul>
                <li><span class="point"><img src="{{asset('img/point.png')}}" alt=""></span>Podrás montar en línea el pedido de los

                    productos del catálogo vigente</li>
                <li><span class="point"><img src="{{asset('img/point.png')}}" alt=""></span>
                    Tu pedido será enviado una vez se verifique tu

                    cupo si eres parte de Crédito Emprendedora,

                    una vez se registre el pago que hagas en

                    las entidades con las que tenemos convenio

                    de pago o en nuestras propias tiendas, el

                    tiempo estimado de respuesta es de 5 días

                    hábiles
                </li>

                <li>
                    <span class="point"><img src="{{asset('img/point.png')}}" alt=""></span>
                    Recuerda que para acceder al 25% de descuento tus compras mínimas deben ser de $300.000
                </li>
            </ul>
            <a target="_blank" href="{{url('img/tiendasemprendedoras.pdf')}}">INSTRUCTIVO PEDIDO EN LINEA</a>
        </article>
    </section>
@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop
