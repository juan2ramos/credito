@extends('layout/front')

@section('content')
    @include('partial.submenu')
    <section class="isEnterprising">
        <h2>QUÉ ES EL SISTEMA EMPRENDEDORA LILI PINK?</h2>
        <p>El sistema EMPRENDEDORA LILI PINK te permitira adquirir nuestros productos para tu propia
            red de ventas a través de un magazine o nuestras tiendas emprendedoras con unas ganancias
            específicas basadas en los montos de compras que tengas.</p>
        <h2>COMO FUNCIONA?</h2>
        <p>Una vez te inscribas en el formulario que encontrarás en la parte inferior recibiras un e-mail
            confirmandote tu registro como EMPRENDEDORA LILIPINK; el magazine lo podrás encontrar
            cada dos meses en nuestras tiendas por un costo de $3.000 ó publicado en línea, el pedido
            de los productos que esten vigentes en el magazine lo puedes hacer en la sección PEDIDO
            EN LINEA de esta pagina web.
        </p>
        <p>Tambien podrás dirigirte a cualquiera de nuestras TIENDAS EMPRENDEDORAS para comprar
            los productos que esten disponibles en tu visita -asi no se encuentren en el magazine vigente
            solamente identificandote como EMPRENDEDORA LILI PINK antes de facturar tu compra.

        </p>
        <h2>CUÁL ES MI GANANCIA?</h2>
        <p>En este sistema tus ganancias se incrementarán acorde a los montos de las compras que
            hagas: tendrás el 20% de ganacias sobre el precio de los productos del magazine o de la
            tienda emprendedora por compras superiores a $300.000; obtendrás el 25% de ganancias
            por compras superiores a $600.000 y el 30% de ganancias por compras superiores a $1´000.000
        </p>
        <a href="" class="">DILIGENCIAR FORMULARIO</a>
        <div class="isEnterprising-contact">
            <h3>TIENES ALGUNA DUDA <span>CONTACTANOS</span></h3>
            <div>
                <p>PBX: (571) 670 2400 Ext: 114 </p>
                <p>Whatsapp: 310 575 6438</p>
                <p>emprendedoras@i-q.com.co</p>
                <p>Cra 19A No 196-23 Bogotá </p>
            </div>
        </div>
    </section>
@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop
