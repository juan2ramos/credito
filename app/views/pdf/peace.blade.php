<html>
<head>
    <style>
        body{
            margin: 1.5cm 1cm 1cm 1cm;
            font-family: 'Calibri', sans-serif;
            font-size: 1.1rem;
        }
        .Container{
            position: relative;
            z-index: 2;
        }
        img{
            width: 100%;
        }
        .background{
            position: absolute;
            top: 25%;
            left: 30px;
            width: 90%;
        }

        .logo{
            width: 220px;
        }
        .text{
            text-align: justify;
        }
        .footer{
            position: absolute;
            bottom: 0;
        }
    </style>
</head>
<body>
    <div class="background">
        <img src="img/pazysalvo.png">
    </div>
    <div class="Container">
        <div class="logo">
            <img src="img/pazysalvoLogo.png">
        </div>
        <h3 style="text-align: center">PAZ Y SALVO</h3>
        <div class="text">
            <p>
                Por medio del presente documento, declaramos en paz y salvo a (la) señor(a)
                <b>{{$user->name}} {{$user->second_name}} {{$user->last_name}} {{$user->second_last_name}}</b>
                identificado(a) con Cédula de Ciudadanía (CC) No.
                <b>{{$user->identification_card}}</b>,
                por concepto de la cancelación total de la(s) obligación(es) adquiridas con
                <b>INNOVA QUALITY SAS.</b>
                Así mismo, informará a las centrales de riesgo con el fin que éstas efectúen la actualización de la información correspondiente.
            </p>
            <br>
            <p> Se expidió en BOGOTA el {{date('d')}} de {{$month}} de {{date('Y')}}, y se imprimió en Sucursal Virtual. </p>
            <br>
            <p>Cordialmente,</p>
            <br>
            <br>
            <p>FIRMA AUTORIZADA INNOVA QUALITY SAS.</p>
            <br>
            <p>IMPORTANTE: Para su seguridad, valide la autenticidad de este documento a través de nuestro conmutador al +57 (1) 6702400 Ext.: 133 - 208. En caso de obtener una respuesta negativa, por favor comuníquese con el área de Crédito y Cartera de Innova Quality SAS.</p>
            <br>
            <br>
            <?php setlocale(LC_TIME, 'es_CO');?>
            <p>Generado el {{date("d/m/Y H:i:s")}}</p>
        </div>
    </div>
    <div class="footer">
        <img src="img/pazysalvoFooter.png">
    </div>
</body>
</html>