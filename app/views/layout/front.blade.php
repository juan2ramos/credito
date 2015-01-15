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

    <script src="{{asset('js/prefixfree.min.js')}}"></script>

    <!-- Humans -->
    <link type="text/plain" rel="author" href="{{asset('humans.txt')}}"/>

</head>
<body>
<header class="Header">
    <div class="Header-content">
        <figure class="Header-logoLilipink">
            <img src="{{asset('img/lilipink_logo.svg')}}" alt=""/></figure>
        <figure class="Header-logoIntima">
            <img src="{{asset('img/intima.svg')}}" alt=""/>
        </figure>
        <div class="Header-contentNav">
            <div id="buttonMenu" class="Header-buttonNav">
                <span class="Header-line1 u-line"></span>
                <span class="Header-line2 u-line"></span>
                <span class="Header-line3 u-line"></span>
            </div>
        </div>
        {{Menus::create('principal',[ 'class'=>'Header-nav'])}}
    </div>
</header>
<div class="wrap">
    @yield('content')
</div>
</body>
<!-- JavaScript -->

<script src="{{asset('js/jquery-1.11.2.min.js')}}"></script>
<script src="{{asset('js/menu.js')}}"></script>
    @yield('javascript')
</html>