@extends('layout/front')

@section('content')
    <section class="Credit u-shadow-5">
        <h2>Estado de cuenta</h2>

        <div style="text-align: center">
            <p style="  font-size: 20px;
  font-weight: 700;">Tu credito fue aceptado por : {{$credit->value}}$</p>
        </div>
        <div class="Table-content">
            <table class="table table-striped table-hover ">
                <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Punto de Venta</th>
                    <th>Tasa de interes</th>
                    <th>Valor de la Compra</th>
                    <th>Cargos y abonos</th>
                    <th>Saldo del Credito</th>
                    <th>Cuotas</th>
                    <th>Saldo sin Vencer</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($extracts as $extract)
                    <tr>
                        <td>{{$extract->numero_documento}}</td>
                        <td>{{$extract->punto_venta}}</td>
                        <td>{{$extract->tasa_interes}}</td>
                        <td>{{$extract->valor_compra}}</td>
                        <td>{{$extract->cargos_abonos}}</td>
                        <td>{{$extract->saldo_credito_diferido}}</td>
                        <td>{{$extract->cuotas}}</td>
                        <td>{{$extract->saldo_sin_vencer}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <section style="  margin: 26px;  padding: 10px;">
            <p>Dias vencidos: {{$vencidos}} dias</p>
            <p>Deuda pendiente por pagar: $ {{$debe}}</p>
        </section>
    </section>



@stop

