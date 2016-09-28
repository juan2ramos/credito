@extends('layout/front')

@section('content')
    @include('partial.submenu')
    <section class="Buy">
        <article class="tienda" >
            <img src="{{asset('img/tiendas.png')}}" alt="">
            <ul>
                <li><span class="point"><img src="{{asset('img/point.png')}}" alt=""> </span><b>CONTADO: </b> Antes de facturar indica

                    que eres una EMPRENDEDORA LILI PINK

                    y presenta tu cédula</li>
                <li><span class="point"><img src="{{asset('img/point.png')}}" alt=""> </span><b>CRÉDITO EMPRENDEDORA: </b>
                    Presenta

                    tu tarjeta, cédula e indica que eres una

                    EMPRENDEDORA LILI PINK.

                    Recuerda que el pago lo debes hacer

                    en un plazo de una (1) cuota - 15 días

                    después de tu compra- en nuestras

                    <span style="color: #BA007C">* TIENDAS LILI PINK :</span>indicando que vas

                    a pagar la cuota de tu crédito

                    emprendedora
                </li>
            </ul>
        </article>
        <article>
            <img class="pedidos" src="{{asset('img/pedidos.png')}}" alt="">
            <ul>
                <li><span class="point"><img src="{{asset('img/point.png')}}" alt=""> </span>Los pagos los puedes hacer en: <br>
                    <span style="color: #BA007C">* TIENDAS LILI PINK:</span><br>



                    En las cajas indicas que vas a pagar un

                    pedido hecho en línea del sistema

                    emprendedoras <br>
                    <span style="color: #BA007C">* BANCOLOMBIA:</span><br>
                    Formato recaudo empresarial <br>

                    a nombre de Innova Quality S.A.S. <br>

                    Cuenta de ahorros 16862920931 <br>

                    Colocar el Referencia el número de pedido<br>
                     <span style="color: #BA007C">* EFECTY</span><br>
                    Convenio 110064<br>
                </li>
            </ul>
<p style="color="#ac0f74">* Recuerda que al ser Crédito Emprendedora solo podrás hacer tus pagos en nuestras tiendas Lili Pink</p>
        </article>
    </section>
@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop
