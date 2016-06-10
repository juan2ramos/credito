<?php
$due = 0;
$lastMonth = 0;
?>

<html>
<head>
    <style>
        body{font-family: Georgia; font-weight: 100;color:#8d8d8d; font-size: 18px}
        .wrapper{padding: 10px 10px}
        span{border: 1px solid #da0080; padding: 10px 0;text-align: right; text-align: center}
        table {  border-collapse: collapse;  border-spacing: 0;  }
        td, th {  vertical-align: top; height: 30px  }
        h1, h2,  th, td { font-weight:normal;margin: 0;padding: 0 }
        h1, h2{font-size: 16px}
        img { border: 0;margin: 0;padding: 0 }
        .back{ background: #ffe9f8}
        .table {border-bottom: 1px solid #da0080;}
        .table tbody{text-align: center;}
        .table th{border: 1px solid #da0080;}
        .table td{border-right: 1px solid #da0080;border-left: 1px solid #da0080;}
        .table td, .table th {box-sizing: border-box;}
        .capitalize{text-transform: capitalize; border:none;}
        .uppercase{text-transform: uppercase; border:none;}
    </style>
</head>
<body>
<table width='530'  class='wrapper'>

    <tr valign='middle'>
        <td>
            <img width='200px' src='img/logocreditos.png'/>
        </td>
        <td>
            <h1 style='opacity: 0; margin: 10px 0'>ESTADO DE CUENTA</h1>
            <h2 style='opacity: 0; margin: 10px 0; border: 1px solid  #da0080; padding: 0 10px'>Interes de mora</h2>
        </td>
    </tr>
    <tr>
        <td>
            Nombre: <span class='capitalize'>{{$user->name}} {{$user->last_name}}</span>
        </td>
        <td style=''>Fecha de facturación
            <div style='width: 195px; display: inline-block; text-align: center; font-size: 14px; '>
                @if($day[1] == '02')
                    <span style='display: inline-block;width:30px;'> 28 </span>
                @else
                    <span style='display: inline-block;width:30px;'> 30 </span>
                @endif

                <span style='display: inline-block;width:30px;'> {{$day[1]}} </span>
                <span style='display: inline-block;width:30px;'> {{$day[0]}} </span>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            Dirección: <span class='capitalize'>{{$user->address}}</span>
        </td>
        <td>Cupo Total
            <span> P </span>
        </td>
    </tr>

    <tr>
        <td>
            Cédula: {{$user->identification_card}}
        </td>
        <td>Cupo Disponible
            <span> P </span>
        </td>
    </tr>
    <tr>
        <td>
            Ciudad: <span class='capitalize'>{{$user->residency_city}}</span>
        </td>
    </tr>

    <tr  class='back' valign='middle'>
        <td>
            PAGUE HASTA
            <span> 05 </span>
            @if((intval($day[1]) + 1) < 10)
                <span> 0{{(intval($day[1]) + 1)}} </span>
            @else
                <span> {{(intval($day[1]) + 1)}} </span>
            @endif
            <span> {{$day[0]}} </span>
        </td>
        <td>PAGO MINIMO
            @if($minPay)
                <span> $ {{number_format($minPay[0]->pago_minimo, 0, '.', '.')}} </span>
            @endif
        </td>
    </tr>
    <tr class='back padding' valign='middle'>
        <td>
            PAGUE TOTAL
            <span> ${{number_format($due + $lastMonth, 0, '.', '.')}} </span>
        </td>
        <td>PAGO FAVOR
            <span> $0 </span>
        </td>
    <tr>
        <td colspan='2'><br/>
            <table class='table' width='100%'>
                <thead>
                <tr style='text-align: center; font-size: 12px' valign='middle'>
                    <th>COMPRA <br /> NÚMERO</th>
                    <th>DD</th>
                    <th>MM</th>
                    <th>AA</th>
                    <th>DETALLE</th>
                    <th style='font-size: 8px'>TASA <br />INTERES</th>
                    <th>VALOR <br /> COMPRA</th>
                    <th>CARGOS Y <br /> ABONOS</th>
                    <th>SALDO <br /> CRÉDITO <br /> DIFERIDO </th>
                    <th>CUOTAS</th>
                </tr>
                </thead>
                <tbody>
                @foreach($extracts as $extract)
                    <?php $date = explode('_', $extract->fecha_contabilizacion); ?>
                <tr>
                    <td>{{$extract->id}}</td>
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
            <br/>
        </td>
    </tr>

    <tr class='back'>
        <td>
            Saldo en mora
            <span> P </span>
        </td>
        <td>
            Gastos legales
            <span> $0 </span>
        </td>
    </tr>

    <tr class='back'>
        <td>
            Compras del mes
            <span> P </span>
        </td>
        <td>
            Cargos no diferidos
            <span> $0 </span>
        </td>
    </tr>
    <tr class='back'>
        <td>
            Intereses
            <span> 0% </span>
        </td>
        <td colspan='2'>
            Honorarios
            <span> $0 </span>
        </td>
    </tr>
    <tr>
        <td colspan='2'>
            <p style='text-align: justify'>
                Cualquier inconformidad favor comunicarla a creditos@innova-quality.com.co, puede enviar comunicación escrita a José Rubiano o Jeimmy Fonseca a la Carrera 20 No 164-13 en Bogotá o comunicarse al PBX: 670 2400 Ext 208 - 133, horario de atención: lunes a viernes de 8:00 a.m. a 5:00 p.m.
                Innova Quality S.A.S. reporta a las centrales de riesgo el incumplimiento de su obligación. Apreciado cliente recuerde que de incurrir en mora se dara inicio a la gestión de cobranza que causara gastos correspondientes conforme a las politicas de Innova Quality S.A.S. que pueden ser consultadas en la pagina web:
                www.creditos.lilipink.com
            </p>
        </td>
    </tr>
</table>
</body>
</html>