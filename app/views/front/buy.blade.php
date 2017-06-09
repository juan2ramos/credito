@extends('layout/front')

@section('content')
    @include('partial.submenu')
    <section class="Buy">
        <article class="tienda">
            <figure><iframe width="430" height="254" src="https://www.youtube.com/embed/F9mDBFVWhgw" frameborder="0" allowfullscreen></iframe></figure>
            <div class="text">
                <h3>TIENDAS LILI PINK EMPRENDEDORAS</h3>
                <p>Una vez te llegue el e-mail de confirmación puedes ir a cualquiera de nuestras tiendas Lili Pink Emprendedoras, hacer compras y obtener el 25%
                    de dcto por compras superiores a $300.000. </p>
                <a href="http://creditoslilipink.com/img/tiendasemprendedoras.pdf" target="_blank" class="link">TIENDAS LILIPINK EMPRENDEDORAS</a>
            </div>
        </article>
        <article class="tienda">
            <figure><iframe width="430" height="254" src="https://www.youtube.com/embed/3bjXbDOHWks" frameborder="0" allowfullscreen></iframe></figure>
            <div class="text">
                <h3>CATÁLOGO VIRTUAL</h3>
                <p>
                    Compra desde la comodidad de tu casa, solamente seleccionas los productos y los añades a tu carrito de compras; en el momento de finalizar
                    la compra te identificas como emprendedora ingresando el e-mail que registraste en el formulario y la contraseña que te enviamos de acceso
                </p>
                <a href="http://lilipink.com/shop" class="link">COMPRAR AHORA</a>
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
