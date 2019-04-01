@extends('layout/front')

@section('content')
    <section class="Buy">
        <article class="tienda faqs">

            <div class="text">
                <h3>CÓMO PUEDO OBTENER MI CRÉDITO LILI PINK</h3>
                <p>Solo debes presentar la cédula original, dos referencias personales y tener buenos hábitos de pago; los cuales serán consultados y verificados en centrales de riesgo. NO NECESITAS CODEUDORES </p>
                <h3>CUÁNDO RECIBO MI CRÉDITO LILI PINK</h3>
                <p>Presentando la cédula original en la tienda en donde solicitaste el crédito o si lo hiciste por la página www.creditoslilipink.com, debes pedirla en la tienda que escogiste en el momento de la inscripción"</p>
                <h3>CÓMO PUEDO INICIAR SESIÓN EN WWW.CREDITOSLILIPINK.COM</h3>
                <p>Debes tener en cuenta lo siguiente:
                    <br>1. Tu usuario es el e-mail registrado en el momento de la solicitud del crédito
                    <br>2. Seguido este paso, das CLICK en “Olvidaste contraseña” para reestablecer una contraseña que
                    sea única para ti
                </p>
                <h3>CÓMO PUEDO CONSULTAR EL ESTADO DE MI CRÉDITO O EL PAGO MÍNIMO</h3>
                <p>Puedes hacerlo a través de los siguientes medios:
                    <br>1. Iniciando sesión en www.creditoslilipink.com
                    <br>2. Llamando a la línea de servicio al cliente en bogotá 670 2400 ext: 208 - 133
                    <br>3. Solicitando la información en cualquier tienda Lili Pink
                </p>
                 </div>
            <figure><img src="{{asset('img/solo_cedula.png')}}"></figure>
        </article>
        <article class="tienda faqs">
            <figure><img src="{{asset('img/sin_codeudor.png')}}"></figure>
            <div class="text">
                <h3>QUE DEBO HACER SI NO PUEDO INICIAR SESIÓN EN WWW.CREDITOSLILIPINK.COM</h3>
                <p>Comunicate a la línea de servicio al cliente en bogotá 670 2400 ext: 208 - 133 </p>
                <h3>ES POSIBLE CAMBIAR LAS FECHAS LIMITES DE PAGO DE MI CRÉDITO</h3>
                <p>No. Las fechas del pago del crédito Lili Pink no pueden ser modificadas a solicitud del cliente</p>
                <h3>SI PRESENTO RETRASO EN MIS CUOTAS</h3>
                <p>Serás reportado a centrales de riesgo y de persistir o continuar la mora o ser superior a 90 días se realizará cobro jurídico. Recuerda que tener buenos hábitos de pago es su mejor carta de presentación ante el comercio y sector financiero</p>
                <h3>CUÁNDO PUEDE ESTAR BLOQUEADO EL CRÉDITO</h3>
                <p>Puede estar cloqueado si presenta mora superior a 30 días, suplantación o perdida</p>
            </div>

        </article>
    </section>
    <div style="text-align: center; margin:10px 0 30px;line-height: 1.3;">
        <b>QUIERES MÁS INFORMACIÓN?</b> <br>
        <a style="color: #000;" href="tel:0316702400">PBX: (571) 670 2400 Ext: 114</a> <br>
        <a style="color: #000;" href="mailto:emprendedoras@i-q.com.co">emprendedoras@i-q.com.co</a> //Cra 19A No 196-23
        Bogotá
    </div>
@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop
