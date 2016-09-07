@extends('layout/front')

@section('content')
    @include('partial.submenu')
    <section class="isEnterprising">
        <h2>QUÉ ES EL SISTEMA EMPRENDEDORA LILI PINK?</h2>
        <p>Convirtiéndote en una EMPRENDEDORA LILI PINK podrás adquirir nuestros productos para tu propia red de ventas a través de un catálogo o nuestras tiendas con una ganancia del 25% sobre el valor de tus pedidos</p>
        <h2>COMO FUNCIONA?</h2>
        <p>Una vez te inscribas en el formulario que encontrarás en la parte inferior en un plazo de un día recibirás un e-mail confirmando tu registro como EMPRENDEDORA LILIPINK; el catálogo lo podrás encontrar cada dos meses en nuestras tiendas por un costo de $3.000 ó publicado en línea, el pedido de los productos que estén vigentes en el catálogo lo puedes hacer en la sección PEDIDO EN LINEA de esta pagina web.</p>
        <p>También podrás dirigirte a cualquiera de nuestras tiendas para comprar los productos que estén disponibles en tu visita así no se encuentren en el catálogo vigente, solamente identificandote como EMPRENDEDORA LILI PINK antes de facturar tu compra.  </p>
        <h2>A TENER EN CUENTA</h2>
        <p>

            * La inscripción es gratuita <br>
            * La vigencia de cada catálogo es de 2 meses <br>
            * Puedes solicitar crédito emprendedora sin codeudor <br>
            * Para acceder a los beneficios de lili pink emprendedora en tiendas, tus compras mínimas deben ser de $300.000
            <br>
            * Podrás realizar varios pedidos dentro de una campaña <br>
            * El pedido mínimo es de $300.000 valor catálogo <br>
            * El envío de tu pedido es gratuito <br>
            * Cuando recibas la caja con el pedido de cada campaña, recuerda verificar que ésta haya llegado completa y en buen estado; de lo contrario, debes notificar a la líneas que se encuentran en la parte inferior con un plazo máximo de un día <br>
            * Invita a nuevas emprendedoras y gana un bono lili pink de $30.000 por su primera compra <br>

        </p>
        <a href="{{route('enterprisingRegister')}}" class="">DILIGENCIAR FORMULARIO</a>
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
