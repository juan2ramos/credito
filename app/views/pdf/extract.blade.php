<?php
$due = 0;
$lastMonth = 0;
$todayDay = intval(date('d'));
$todayMonth = intval(date('m'));
?>
@if(intval(date('d')) == 31)
    <?php $todayDay = 30; $todayMonth -= 1; ?>
@endif

@foreach($extracts as $extract)
    <?php $date = explode('_', $extract->fecha_contabilizacion); ?>
    @if($extract->fecha_contabilizacion)
        @foreach($months as $key => $m)
            @if(strtolower($key) == strtolower($date[0]))
                @if($m == $todayMonth || ($m + 1 == $todayMonth && $todayDay <= 5))
                    <?php $due += $extract->valor_compra ?>
                @else
                    <?php $lastMonth += $extract->valor_compra ?>
                @endif
            @endif
        @endforeach
    @endif
@endforeach

<?php $total = $due + $lastMonth ?>

<!--<td>
    Compras del mes
    <span> ${number_format($due, 0, '.', '.')}} </span>
</td>-->

<html>
<head>
    <style>

        *{
            padding: 0;
        }
        body{
            width: 100%;
            max-width: 100%;
            padding: 94px;
            font-size: 18px;
            font-family: 'Arial', sans-serif;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }
        thead th, tbody th{
            font-weight: 100;
        }
        thead th{
            font-size: .7rem;
            padding: 3px 2px;
        }
        tbody th{
            font-size: .65rem;
            font-weight: 100;
            padding: 5px 1px;
        }
        .Container{
            padding: 5px 0;
        }
        .input{
            height: 20px;
            padding: 0 4px;
            border: 2px solid #dc2386;
        }
        .table{
            width: 100%;
            position: relative;
        }
        .table.pink{
            background: #FCE9F3;
        }
        .table.border td, .table.border th{
            border: 2px solid #dc2386;
        }
        [class*="col-"]{
            display: inline-block;
            margin-right: -4px;
        }
        .col-6{
            width: 50%;
        }
        .col-4{
            width: 33.33%;
        }
        .gray{
            color: #a2a0a5;
        }
        .center{
            text-align: center;
        }
        .text{
            font-size: 16px;
            font-weight: 200;
        }
    </style>
</head>
<body>
<table class="table" style="table-layout:fixed">
    <tr style="max-width: 50%">
        <td>
            <img src="img/lilipinkPDF.png">
        </td>
        <td>
            <div class="Container">
                <span class="title">ESTADO DE CUENTA</span>
                <div class="input text" style="margin-top: 14px">Otros cargos administrativos</div>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <span class="title">Nombre : <span class='capitalize'>{{$user->name}} {{$user->last_name}}</span></span>
        </td>
        <td>
            <div class="Container">
                <span class="title col-6">Fecha Facturación</span>
                <div class="gray center" style="position: absolute; right: 36px; width: 138px">
                    <span class="input col-4" style="border-right: none;">
                        @if($day[1] == '02')
                            28
                        @else
                            30
                        @endif
                    </span>
                    <span class="input col-4" style="border-right: none;">{{$day[1]}}</span>
                    <span class="input col-4" >{{$day[0]}}</span>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <span class="title">Dirección : {{$user->address}}</span>
        </td>
        <td>
            <div class="Container">
                <span class="title col-6">Cupo Total</span>
                <div class="center" style="position: absolute; right: 36px; width: 138px">
                    <span class="input col-6" style="width: 160px">${{number_format($quota, 0, '.', '.')}}</span>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <span class="title">Cédula : {{$user->identification_card}}</span>
        </td>
        <td>
            <div class="Container">
                <span class="title col-6">Cupo Disponible</span>
                <div class="center" style="position: absolute; right: 36px; width: 138px">
                    <span class="input col-6" style="width: 160px">${{number_format(($quota - $total), 0, '.', '.')}}</span>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <span class="title">Ciudad : <span style="text-transform: capitalize;">{{$user->residency_city}}</span></span>
        </td>
        <td>
            <div class="Container" style="visibility: hidden; opacity: 0">
                <span class="title col-6"></span>
                <div class="center" style="position: absolute; right: 36px; width: 138px">
                    <span class="input col-6" style="width: 160px">NO EXISTE</span>
                </div>
            </div>
        </td>
    </tr>
</table>
<table class="table pink" style="padding: 4px 20px">
    <tr>
        <td>
            <div class="Container">
                <span class="title col-6">PAGUE HASTA</span>
                <div class="gray center" style="position: absolute; left: 166px; width: 138px">
                    <span class="input col-4" style="border-right: none;">05</span>
                    <span class="input col-4" style="border-right: none;">
                        @if((intval($day[1]) + 1) < 10)
                            0{{(intval($day[1]) + 1)}}
                        @else
                            {{(intval($day[1]) + 1)}}
                        @endif
                    </span>
                    <span class="input col-4" >{{$day[0]}}</span>
                </div>
            </div>
        </td>
        <td>
            <div class="Container">
                <span class="title col-6">PAGO MINIMO</span>
                <div class="center" style="position: absolute; right: 56px; width: 138px">
                    <span class="input col-6" style="width: 160px">
                        @if(count($minPay))
                            ${{number_format($minPay[0]->pago_minimo, 0, '.', '.')}}
                        @else
                            $0
                        @endif
                    </span>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="Container">
                <span class="title col-6">PAGO TOTAL</span>
                <div class="center" style="position: absolute; left: 166px; width: 138px">
                    <span class="input col-6" style="width: 160px">${{number_format($total, 0, '.', '.')}}</span>
                </div>
            </div>
        </td>
        <td>
            <div class="Container">
                <span class="title col-6">SALDO A FAVOR</span>
                <div class="center" style="position: absolute; right: 56px; width: 138px">
                    <span class="input col-6" style="width: 160px">$0</span>
                </div>
            </div>
        </td>
    </tr>
</table>
<table class="table border" style="margin-top: 10px; text-align: center;">
    <thead>
    <tr>
        <th>COMPRA<br>NUMERO</th>
        <th>DD</th>
        <th>MM</th>
        <th>AA</th>
        <th>DETALLE</th>
        <th>% OTROS <br> CARGOS</th>
        <th>VALOR <br> COMPRA</th>
        <th>CARGOS <br> Y ABONOS</th>
        <th>SALDO <br> CREDITO <br> DIFERIDO</th>
        <th>CUOTAS</th>
    </tr>
    </thead>
    <tbody>
    @foreach($extracts as $extract)
        <?php $date = explode('_', $extract->fecha_contabilizacion);?>
        <tr>
            <td>{{$extract->numero_documento}}</td>
            @if($extract->fecha_contabilizacion)
                <td> {{$date[1]}} </td>
                <td> {{$date[0]}} </td>
                <td> {{$date[2]}} </td>
            @else
                <td></td>
                <td></td>
                <td></td>
            @endif

            <td> {{$extract->punto_venta}} </td>
            <td> {{number_format($extract->tasa_interes, 0, '.', '.')}}% </td>
            <td> ${{number_format($extract->valor_compra, 0, '.', '.')}} </td>
            <td> ${{number_format($extract->cargos_abonos, 0, '.', '.')}} </td>
            <td> ${{number_format($extract->saldo_credito_diferido, 0, '.', '.')}} </td>
            <td> {{$extract->cuotas}} </td>
        </tr>
    @endforeach
    </tbody>
</table>
<table class="table pink" style="padding: 4px 20px; margin-top: 18px">
    <tr>
        <td>
            <div class="Container">
                <span class="title col-6">Saldo en mora</span>
                <div class="center" style="position: absolute; left: 166px; width: 138px">
                    <span class="input col-6" style="width: 160px">
                        @if(count($minPay))
                            ${{number_format($minPay[0]->pago_minimo, 0, '.', '.')}}
                        @else
                            $0
                        @endif
                    </span>
                </div>
            </div>
        </td>
        <td>
            <div class="Container">
                <span class="title col-6">Gastos Legales</span>
                <div class="center" style="position: absolute; right: 56px; width: 138px">
                    <span class="input col-6" style="width: 160px">$0</span>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="Container">
                <span class="title col-6">Otros cargos</span>
                <div class="center" style="position: absolute; left: 166px; width: 138px">
                    <span class="input col-6" style="width: 160px">$0</span>
                </div>
            </div>
        </td>
        <td>
            <div class="Container">
                <span class="title col-6">Cargos no diferidos</span>
                <div class="center" style="position: absolute; right: 56px; width: 138px">
                    <span class="input col-6" style="width: 160px">$0</span>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="Container">
                <span class="title col-6">Honorarios</span>
                <div class="center" style="position: absolute; left: 166px; width: 138px">
                    <span class="input col-6" style="width: 160px">$0</span>
                </div>
            </div>
        </td>
        <td>
            <div class="Container">
                <span class="title col-6">Notas de crédito</span>
                <div class="center" style="position: absolute; right: 56px; width: 138px">
                    <span class="input col-6" style="width: 160px"></span>
                </div>
            </div>
        </td>
    </tr>
</table>
<div class="leyend">
    <p style='text-align: justify'>
        Cualquier inconformidad favor comunicarla a carterainnova@innova-quality.com.co, puede enviar comunicación escrita al departamento de Crédito y Cartera en la Carrera 19a No 196 - 23 en Bogotá o comunicarse al PBX: 670 2400 Ext. 219, 208, 218, 133, horario de atención: Lunes a Viernes de 7:00 a.m. a 7:00 p.m.
    </p>
    <p style='text-align: justify'>
        Innova Quality S.A.S. De acuerdo con el articulo 12 de la ley 1266 reporta a las centrales de riesgo el incumplimiento de su obligación. Apreciado cliente recuerde que de incurrir en mora se dará inicio a la gestión de cobranza que causara gastos correspondientes conforme a las politicas de Innova Quality S.A.S, que pueden ser consultadas en la pagina web: www.creditoslilipink.com.
    </p>
</div>
</body>
</html>