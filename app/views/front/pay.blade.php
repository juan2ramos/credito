@extends('layout/front')

@section('content')
    @include('partial.submenu')
    <section class="Buy">
        <article class="tienda">
            <figure><img src="{{asset('img/2.png')}}"></figure>
            <div class="text">
                <h3>TIENDAS LILI PINK EMPRENDEDORAS</h3>
                <p>EMPRENDEDORA CONTADO: <br>
                    Identificate como una emprendedora, presenta tu cédula y cancela tus compras en la caja
                </p>
                <p>CRÉDITO EMPRENDEDORA: <br>
                    Una vez hagas tus compras, identificate como emprendedora con crédito. Recuerda que tu compra automaticamente se diferira a 1 cuota
                    con pago a los 15 días de la fecha de tu factura
                </p>
                </div>
        </article>
        <article class="tienda">
            <figure><img src="{{asset('img/1.png')}}"></figure>
            <div class="text">
                <h3>CATÁLOGO VIRTUAL</h3>
                <p>
                    Una vez hagas tus compras, ingresa como crédito emprendedora  o emprendedora contado con tu e-mail registrado en el formulario de
                    registro y la contraseña que te enviamos <br>
                    EMPRENDEDORA CONTADO: <br>
                    Para hacerte el envio de tu compra, debes cancelar en: <br>
                  
                    * PAYU <br>
                    Realiza tu pago en línea: debito, crédito, baloto <br>
                    Una vez hagas el pago notificalo a emprendedoras@i-q.com.co o a nuestro whatsapp: 310 575 6438
                </p>
                <p>
                    EMPRENDEDORA CRÉDITO: <br>
                    El sistema te pedira que aceptes la forma de pago: Pago diferido a una cuota para pago a los 15 días en una tienda Lili Pink Emprendedora, una vez des el aprobado empezaremos a alistar tu pedido
                </p>

            </div>
        </article>
    </section>
    <div style="text-align: center; margin:10px 0 30px;line-height: 1.3;">
        <b>QUIERES MÁS INFORMACIÓN?</b> <br>
        <a style="color: #000;" href="tel:0316702400">PBX: (571) 670 2400 Ext: 114</a>  <a style="color: #000;" href="tel:3105756438">// Whatsapp: 310 575 6438</a>  <br>
        <a style="color: #000;" href="mailto:emprendedoras@i-q.com.co">emprendedoras@i-q.com.co</a> //Cra 19A No 196-23 Bogotá
    </div>
@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop
