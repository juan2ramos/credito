@extends('layout/front')

@section('content')
    @include('partial.submenu')
    <section class="Buy">
        {{-- <article class="tienda">
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
         </article>--}}
        <article class="tienda">
            <figure><img src="{{asset('img/1.png')}}"></figure>
            <div class="text">
                <h3>PÁGINA WEB</h3>
                <p>
                    Ingresa a www.lilipink.com y cuando termines de hacer tus compras coloca el correo que registraste
                    en el formulario de inscripción, asi la pagina te reconocerá como emprendedora
                </p>
                <h3>EMPRENDEDORA CONTADO:</h3>
                <p>
                    * MERCADOPAGO <br>
                    Realiza tu pago en línea: débito, crédito, efecty, consignación<br>
                    * CONTRAENTREGA<br>
                    Si tu ciudad tiene cubrimiento de este servicio cancela el pedido una vez te sea entregado por
                    coordinadora
                </p>
                <h3>EMPRENDEDORA CRÉDITO</h3>
                <p>* Selecciona como forma de pago tu crédito, recuerda que lo deberás cancelar a los 15 días de la fecha de la factura. Una vez selecciones este medio de pago, confirmaremos tu cupo y te enviaremos un pagaré para que nos regreses la autorización del pago</p>
            </div>
        </article>
    </section>
    <div style="text-align: center; margin:10px 0 30px;line-height: 1.3;">
        <b>QUIERES MÁS INFORMACIÓN?</b> <br>
        <a style="color: #000;" href="tel:0316702400">PBX: (571) 670 2400 Ext: 114</a> <a style="color: #000;"
                                                                                          href="tel:3105756438">//
            Whatsapp: 310 575 6438</a> <br>
        <a style="color: #000;" href="mailto:emprendedoras@i-q.com.co">emprendedoras@i-q.com.co</a> //Cra 19A No 196-23
        Bogotá
    </div>
@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop
