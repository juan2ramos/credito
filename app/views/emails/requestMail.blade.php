<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Creditos Lilipink - Intimasecret</title>

    <link rel="shortcut icon" href="http://lilipink.com/wp-content/uploads/2014/10/favicon1.ico">
</head>

<body>

<div>
    <h1>Se ha solicitado un credito </h1>
    <div>
        <p>Nombres : {{$name}} {{$second_name}} {{$last_name}} {{$second_last_name}}</p>
        <p>Correo : {{$email}}</p>
        <p>telefono : {{$phone}}</p>
        <p>Celular : {{$mobile_phone}}</p>
        {{ HTML::link(URL::to($link), 'Ver la solicitudes de credito ') }}
    </div>
</div>
</body>
</html>