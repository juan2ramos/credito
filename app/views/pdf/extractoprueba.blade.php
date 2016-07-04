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
                <span class="title">Nombre : Santiago Ruiz Espitia</span>
            </td>
            <td>
                <div class="Container">
                    <span class="title col-6">Fecha Facturación</span>
                    <div class="gray center" style="position: absolute; right: 36px; width: 138px">
                        <span class="input col-4" style="border-right: none;">28</span>
                        <span class="input col-4" style="border-right: none;">06</span>
                        <span class="input col-4" >16</span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <span class="title">Dirección : CR 45B 69C 33</span>
            </td>
            <td>
                <div class="Container">
                    <span class="title col-6">Cupo Total</span>
                    <div class="center" style="position: absolute; right: 36px; width: 138px">
                        <span class="input col-6" style="width: 160px">$300.000</span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <span class="title">Cédula : 1031146949</span>
            </td>
            <td>
                <div class="Container">
                    <span class="title col-6">Cupo Total</span>
                    <div class="center" style="position: absolute; right: 36px; width: 138px">
                        <span class="input col-6" style="width: 160px">$100.000</span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <span class="title">Ciudad : Bogota</span>
            </td>
            <td>
                <div class="Container" style="visibility: hidden; opacity: 0">
                    <span class="title col-6">Cupo Total</span>
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
                        <span class="input col-4" style="border-right: none;">28</span>
                        <span class="input col-4" style="border-right: none;">06</span>
                        <span class="input col-4" >16</span>
                    </div>
                </div>
            </td>
            <td>
                <div class="Container">
                    <span class="title col-6">PAGO MINIMO</span>
                    <div class="center" style="position: absolute; right: 56px; width: 138px">
                        <span class="input col-6" style="width: 160px"></span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="Container">
                    <span class="title col-6">PAGO TOTAL</span>
                    <div class="center" style="position: absolute; left: 166px; width: 138px">
                        <span class="input col-6" style="width: 160px"></span>
                    </div>
                </div>
            </td>
            <td>
                <div class="Container">
                    <span class="title col-6">SALDO A FAVOR</span>
                    <div class="center" style="position: absolute; right: 56px; width: 138px">
                        <span class="input col-6" style="width: 160px"></span>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <table class="table border" style="margin-top: 10px">
        <thead>
            <tr>
                <th>ID</th>
                <th>DD</th>
                <th>MM</th>
                <th>AA</th>
                <th>DETALLE</th>
                <th>% OTROS CARGOS</th>
                <th>VALOR COMPRA</th>
                <th>CARGOS Y ABONOS</th>
                <th>SALDO CREDITO DIFERIDO</th>
                <th>CUOTAS</th>
            </tr>
        </thead>
        <tbody>
            @for($i = 0; $i < 10; $i++)
                <tr>
                    <th>1</th>
                    <th>18</th>
                    <th>06</th>
                    <th>16</th>
                    <th>Punto Toberin</th>
                    <th>0%</th>
                    <th>$300.000</th>
                    <th>$0</th>
                    <th>$300.000</th>
                    <th>12</th>
                </tr>
            @endfor
        </tbody>
    </table>
    <table class="table pink" style="padding: 4px 20px; margin-top: 18px">
        <tr>
            <td>
                <div class="Container">
                    <span class="title col-6">Saldo en mora</span>
                    <div class="center" style="position: absolute; left: 166px; width: 138px">
                        <span class="input col-6" style="width: 160px"></span>
                    </div>
                </div>
            </td>
            <td>
                <div class="Container">
                    <span class="title col-6">Gastos Legales</span>
                    <div class="center" style="position: absolute; right: 56px; width: 138px">
                        <span class="input col-6" style="width: 160px"></span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="Container">
                    <span class="title col-6">Otros cargos</span>
                    <div class="center" style="position: absolute; left: 166px; width: 138px">
                        <span class="input col-6" style="width: 160px"></span>
                    </div>
                </div>
            </td>
            <td>
                <div class="Container">
                    <span class="title col-6">Cargos no diferidos</span>
                    <div class="center" style="position: absolute; right: 56px; width: 138px">
                        <span class="input col-6" style="width: 160px"></span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="Container">
                    <span class="title col-6">Honorarios</span>
                    <div class="center" style="position: absolute; left: 166px; width: 138px">
                        <span class="input col-6" style="width: 160px"></span>
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
            Cualquier inconformidad favor comunicarla a creditos@innova-quality.com.co, puede enviar comunicación escrita a Jeimmy Fonseca o José Rubiano a la Carrera 19a No 196 - 23 sector Canaima en Bogotá o comunicarse al PBX: 670 2400 Ext 208 - 133, horario de atención: lunes a viernes de 8:00 a.m. a 5:00 p.m.
            Innova Quality S.A.S. reporta a las centrales de riesgo el incumplimiento de su obligación. Apreciado cliente recuerde que de incurrir en mora se dara inicio a la gestión de cobranza que causara gastos correspondientes conforme a las politicas de Innova Quality S.A.S.
        </p>
    </div>
</body>
</html>