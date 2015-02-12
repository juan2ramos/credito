@extends('layout/front')

@section('content')

    <div class="Back-content">
        {{ HTML::link(URL::to('solicitud'), 'atras',array('class'=>'login-button')) }}
    </div>

    <h1>Aceptacion del credito</h1>

    <section class="acceptSection">
        <h2>datos personales</h2>
        {{Form::open(array('url'=>'showCreditRequest/'.$credit->id,'method'=>'POST','class'=>""))}}
        <div class="Table-content">
            <table class="table table-striped table-hover ">
                <thead>
                <tr>
                    <th>nombres</th>
                    <th>Cedula</th>
                    <th>Celular</th>
                    <th>Telefono</th>
                    <th>fecha de nacimiento</th>
                    <th>Direccion</th>
                    <th>Egresos mensuales</th>
                    <th>Ingresos mensuales</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$user->name." ".$user->last_name}}</td>
                    <td>{{$user->identification_card}}</td>
                    <td>{{$user->mobile_phone}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->date_birth}}</td>
                    <td>{{$user->address}}</td>
                    <td>{{$credit->monthly_expenses}}</td>
                    <td>{{$credit->monthly_income}}</td>

                </tr>
                </tbody>
            </table>
        </div>
        <div class="accept-content">
            <label class="accpt-checkbox">
                {{Form::checkbox('data_monthly', 1, null, ['class' => 'checkbox'])}}
                Datos cuota mensual
            </label>

            <label class="accpt-checkbox">
                {{Form::checkbox('value_monthly', 1, null, ['class' => 'checkbox'])}}
                Valor cuota mensual
            </label>

            <label class="accpt-checkbox">
                {{Form::checkbox('data_credit', 1, null, ['class' => 'checkbox'])}}
                Data credito
            </label>
        </div>



        <h2>Referencia 1</h2>

        <div class="Table-content">
            <table class="table table-striped table-hover ">
                <thead>
                <tr>
                    <th>nombre</th>
                    <th>telefono</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$credit->name_reference}}</td>
                    <td>{{$credit->phone_reference}}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <label class="accpt-checkbox">
            {{Form::checkbox('reference1', 1, null, ['class' => 'checkbox'])}}
            Referencia 1 confirmada
        </label>

        <h2>Referencia 2</h2>

        <div class="Table-content">
            <table class="table table-striped table-hover ">
                <thead>
                <tr>
                    <th>nombre</th>
                    <th>telefono</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>cedula</td>
                    <td>name</td>
                </tr>
                </tbody>
            </table>
        </div>

        <label class="accpt-checkbox">
            {{Form::checkbox('reference2', 1, null, ['class' => 'checkbox'])}}
            Referencia 2 confirmada
        </label>

        <h2>archivos</h2>
        <div class="Table-content">
            <table class="table table-striped table-hover ">
                <thead>
                <tr>
                    @foreach($images as $image)
                        @if($image=="")
                        @else
                            <th>archivo</th>
                        @endif

                    @endforeach
                </tr>
                </thead>
                <tbody>
                <tr>

                    @foreach($images as $image)
                            @if(strpos($image,"jpg"))
                                <td>
                                    {{ HTML::image('img/jpg.png','', array ('id' => 'showFiles')) }}
                                    {{ HTML::link(URL::to('upload/'.$image), 'mostrar',array('id'=>'textTable','target'=>'_blank')) }}
                                </td>
                            @endif
                            @if(strpos($image,"png"))
                                <td>
                                    {{ HTML::image('img/jpg.png','', array ('id' => 'showFiles')) }}
                                    {{ HTML::link(URL::to('upload/'.$image), 'mostrar',array('id'=>'textTable','target'=>'_blank')) }}
                                </td>
                            @endif
                            @if(strpos($image, "pdf"))
                                <td>
                                    {{ HTML::image('img/pdf.png','', array ('id' => 'showFiles')) }}
                                    {{ HTML::link(URL::to('upload/'.$image), 'mostrar',array('id'=>'textTable','target'=>'_blank')) }}
                                </td>

                            @endif
                            @if(strpos($image, "docx"))
                                <td>
                                    {{ HTML::image('img/doc.png','', array ('id' => 'showFiles')) }}
                                    {{ HTML::link(URL::to('upload/'.$image), 'descargar',array('id'=>'textTable','target'=>'_blank')) }}
                                </td>
                            @endif
                    @endforeach

                </tr>
                </tbody>
            </table>
        </div>

        <label class="accpt-checkbox">
            {{Form::checkbox('files', 1, null, ['class' => 'checkbox'])}}
            Archivos correctos
        </label>

        <button class="u-button">
            Guardar Cambios
        </button>
        {{Form::close()}}
    </section>


@stop
