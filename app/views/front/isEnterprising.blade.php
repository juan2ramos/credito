@extends('layout/front')

@section('content')
    @include('partial.submenu')
    <section class="isEnterprising">
        <h2>QUÉ ES EL SISTEMA EMPRENDEDORA LILI PINK?</h2>
        <p>Convirtiéndote en una EMPRENDEDORA LILI PINK podrás adquirir nuestros productos para tu propia red de ventas a través de compra en tienda virtual con una  <span> ganancia del 25% </span>sobre el valor de tus pedidos</p>
        <h2>COMO FUNCIONA?</h2>
        <p>Una vez diligencias el formulario de inscripción recibirás un e-mail de confirmación en un plazo de un día, luego podrás acceder a comprar en  nuestra pagina web con el beneficio del  <span>25% de ganancia</span> por compras minimas de $300.000</p>
        <h2>PAGOS DE CONTADO Y A CRÉDITO EMPRENDEDORA</h2>
        <p>Tenemos dos modalidades de pago, selecciona en el formulario la que más te convenga:<br>
            * Contado: si compras en la tienda virtual, debes pagar en efect, bancolombia o payu para hacerte el envio; si compras en tiendas Lili Pink Emprendedora, te presentas como emprendedora y haces tu pago para retirar los productos<br>
            * Crédito: tanto tus compras virtuales como en tiendas Lili Pink Emprendedora se difieren a 1 cuota para pago a 15 días en nuestras tiendas </p>
        <h2>A TENER EN CUENTA</h2>
        <p>

            * La inscripción es gratuita<br>
            * Puedes solicitar el crédito Lili Pink Emprendedora SIN CODEUDOR  <br>
            * La tienda virtual esta en constante actualización para brindarte lo más nuevo de nuestros productos
            * Cuando hagas compras en linea con tu crédito emprendedora, debes notificar al whatsapp 310 575 6438 para que envien a tu correo el formato de autorización
            * El beneficio del 25% de dcto en  tienda virtual tienen como compra minima $300.000<br>
            * El envio GRATUITO de tu pedido desde nuestra tienda virtual  tiene como compra minima $300.000, el resto de compras tienen un costo de envio de $5.000 <br>
            * Una vez recibas tu pedido de la tienda virtual, , revisa que haya llegado completo y en perfecto estado; de lo contrario debes notificar en las lineas que se encuentran  en la parte inferior en un plazo máximo de 1 día <br>

        </p>
        <h2>CAMBIOS Y DEVOLUCIONES</h2>
        <p>Por razones de higiene no se aceptan cambios o devoluciones de prendas intimas como panties, conjuntos, fajas o vestidos de baño excepto cuando hayan defectos
            de fabricación, que serán evaluados por nuestro departamento de calidad, previa presentación del caso y autorización al correo emprendedoras@i-q.com.co.
        </p>
        <p>Puedes realizar cambio de  brasieres o tops en un plazo máximo de 5 días, tras recibir  el pedido. Los artículos que vas a cambiar deben estar en perfectas condiciones,
            con las etiquetas aún puestas y en su empaque original. </p>
        <p>En la realización de los cambios, los costos de envío serán asumidos por el usuario exceptuando los casos previamente comprobados en los que se haya registrado
            algún defecto de fabricación. </p>
    </section>
    <section class="welcome">
        <a href="{{route('enterprisingRegister')}}" > <img src="{{asset('img/bienvenida.png')}}"></a>
    </section>
    <div style="text-align: center; margin:10px 0 30px;line-height: 1.3;">
        <b>QUIERES MÁS INFORMACIÓN?</b> <br>
        <a style="color: #000;" href="tel:0316702400">PBX: (571) 670 2400 Ext: 114</a>    <br>
        <a style="color: #000;" href="mailto:emprendedoras@i-q.com.co">emprendedoras@i-q.com.co</a> //Cra 19A No 196-23 Bogotá
    </div>
@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop
