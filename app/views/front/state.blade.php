@extends('layout/front')

@section('content')
    <section class="Credit u-shadow-5">
        <div style="text-align: center">
            <p style="  font-size: 20px;
  font-weight: 700;">Tu credito fue aceptado por : ${{number_format($credit->value, 0, '.', '.')}}</p>
        </div>

        <div class="Table-content">
            <table class="table table-striped table-hover ">
                <thead>
                <tr>
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
                        <td>{{$extract->punto_venta}}</td>
                        <td>{{$extract->tasa_interes}}%</td>
                        <td>${{number_format($extract->valor_compra, 0, '.', '.')}}</td>
                        <td>{{$extract->cargos_abonos}}</td>
                        <td>${{number_format($extract->saldo_credito_diferido, 0, '.', '.')}}</td>
                        <td>{{$extract->cuotas}}</td>
                        <td>${{number_format($extract->saldo_sin_vencer, 0, '.', '.')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <section style="  margin: 26px;  padding: 10px;">
            <p>Dias vencidos: {{$vencidos}} dias</p>
            <p>Deuda pendiente por pagar: $ {{$debe}}</p>
            @if(!$debe)
                <form action="{{route('peace', $user->id)}}" method="post">
                    <button class="u-button" style="cursor:pointer; width: 200px">Descargar paz y salvo</button>
                </form>
            @else
                <a href="{{route('ExtractPdf', $user->identification_card)}}" class="u-button" style="display:block; text-align: center; margin-top: 10px; cursor:pointer; width: 200px">Descargar Extracto</a>
            @endif
            <br>
        </section>
    </section>
@stop

