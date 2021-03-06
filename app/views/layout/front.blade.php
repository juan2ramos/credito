<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="es">
<head>

    <title>@section('title') Créditos  @show</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="author" content="juan2ramos"/>
    <meta name="description" content="Tu crédito rápido"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1"/>

    <!-- Style -->
    <link rel="stylesheet" href="{{asset('css/normalize.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/style.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    @yield('styles')

    <script src="{{asset('js/prefixfree.min.js')}}"></script>

    <!-- Humans -->
    <link type="text/plain" rel="author" href="{{asset('humans.txt')}}"/>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
 <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TRM7ND4');</script>
<!-- End Google Tag Manager -->
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
            document,'script','https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1780936552169462'); // Insert your pixel ID here.
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=1780936552169462&ev=PageView&noscript=1"
        /></noscript>
    <!-- DO NOT MODIFY -->
    <!-- End Facebook Pixel Code -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TRM7ND4"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="body-all">
<header class="Header">
    <div class="content-header">
        <div class="Header-content">
            <figure class="Header-logoLilipink">
                <img src="{{asset('img/lilipink_logo.svg')}}" alt=""/></figure>
            <figure class="Header-logoIntima">
                <img src="{{asset('img/intima.svg')}}" alt=""/>
            </figure>
            <div class="Header-contentNav">
                @if(Auth::check())
                    <a class="icon-logout" href="{{route('logout')}}"></a>
                    @if(Auth::user()->roles_id == 3)
                        <a class="icon-bell" href="{{route('request')}}"> <span>{{notify()}}</span> </a>
                    @endif
                    <a class="icon-child-1" href="{{route('update',Auth::user()->id)}}"></a>
                @else
                    <a class="login-button" href="{{route('sign-up')}}">Iniciar sesión</a>
                @endif
                    <div id="buttonMenu" class="Header-buttonNav">
                        <span class="Header-line1 u-line"></span>
                        <span class="Header-line2 u-line"></span>
                        <span class="Header-line3 u-line"></span>
                    </div>
            </div>
            {{Menus::create('principal',[ 'class'=>'Header-nav'])}}
        </div>
    </div>
    <figure class="Logo">
        <img class="Logo-img" src="{{asset('img/lilipink.svg')}}" alt="Lilipink"/>
    </figure>
    <div id="header-menu" >
        {{Menus::create('principal',[ 'class'=>''])}}
    </div>
</header>
<div class="wrap">
    @yield('content')
</div>
</div>
    <div class="content-social" >

        <div class="social-text">
            <p>Siguenos en nuestras Redes Sociales</p>

            <a href="https://www.facebook.com/LiliPinkColombia" target="_blank" class="icon-facebook-1"></a>

            <a href="http://www.twitter.com/LILI_PINK_col" target="_blank" class="icon-twitter-1"></a>

            <a href="http://pinterest.com/lilipinkCol/?e_t_s=fullname&e_t=aa6f4bc889ae46b787b994acec4e3c1c&utm_source=sendgrid.com&utm_medium=email&utm_campaign=activity_aggregation" target="_blank" class="icon-youtube"></a>

            <a href="https://www.youtube.com/user/tiendasintimasecret" target="_blank" class="icon-youtube"></a>

            <a href="http://instagram.com/intimasecret_lilipink" target="_blank" class="icon-instagramm"></a>

        </div>

    </div>
    <footer>
        <p>®Lilipink Todos los derechos reservados - 2016 -  Diseño Web - Ártico Digital S.A.S</p>
    </footer>

<div id="modal">
    <a href="#cerrar"></a>
    <div id="modalContent-contact">

        <section id="wraper-contact">

            <article>

                <h2>CONTÁCTANOS</h2>
                <p>Escríbenos a, pronto estaremos en <br> contacto contigo.</p>
                <p>Comunícate con Servicio al Cliente al <b>(57) 6702400 Ext 133 y 208</b> en Bogotá o Escríbenos un <b>carterainnova@innova-quality.com.co </b> </p>
            </article>
            {{  Form::open(array('route' => 'contact')) }}

                <label>Nombre (requerido):</label>
                <input type="text" id="contact0" name="nombre" value="">
                <label>Correo electrónico (requerido):</label>
                <input type="text" id="contact1" name="correo" value="">
                <label>Ciudad (requerido):</label>
                <input type="text" id="contact2" name="ciudad" value="">
                <label>Mensaje (requerido):</label>
                <textarea tapindex="4" id="contact3" name="mensaje"></textarea>
            <div style="    margin: 1rem auto; width: 300px;"  class="g-recaptcha" data-sitekey="6Lc5LhgTAAAAAJTsoqyXgUsp5DcYGeXtJNFw17-8"></div>
                <input id="campo3" name="enviar" type="submit" value="Enviar" class="bttn skin">

            {{ Form::close() }}
        </section>

        <a id="cerrar" href="#">X</a>
    </div>
</div>
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
    (function(){ var widget_id = 'N2lYHRxXJo';var d=document;var w=window;function l(){
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!-- {/literal} END JIVOSITE CODE -->


</body>
<!-- JavaScript -->

<script src="https://code.jquery.com/jquery-2.0.0.min.js" integrity="sha256-1IKHGl6UjLSIT6CXLqmKgavKBXtr0/jJlaGMEkh+dhw=" crossorigin="anonymous"></script>
<!--<script src="{{asset('js/jquery-1.11.2.min.js')}}"></script>-->


<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/menu.js')}}"></script>
@yield('javascript')
</html>
