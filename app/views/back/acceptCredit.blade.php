@extends('layout/front')

@section('content')

    @if($errors->first('accept'))
        <section class="accept-links">
            <a href="{{route('reprobateCredit', $user->id)}}" class="u-button">Reprobar el credito</a>
        </section>
    @endif

    <div class="Back-content">
        {{ HTML::link(URL::to('solicitud'), 'atras',array('class'=>'login-button')) }}
    </div>

    <h1>Aceptacion del credito</h1>

    <section class="acceptSection">
        {{Session::get('enterprising')}}
        <h2>Datos personales @if($priority == 2) (Emprendedora) @endif</h2>
        {{Form::open(['route'=> ['acceptCredit', $user->id],'method'=>'POST','class'=>""])}}

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
                    <th>Punto de venta</th>
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
                    <td>{{$user->CreditRequest->monthly_expenses}}</td>
                    <td>{{$user->CreditRequest->monthly_income}}</td>
                    @if(isset($point->name))
                        <td>{{$point->name}}</td>
                    @else
                        <td>No tiene punto asignado</td>
                    @endif
                </tr>
                </tbody>
            </table>
        </div>

        <div class="input-content">
            <div class="material-input">
                {{Form::text('data_monthly','',['id' => 'data_monthly'])}}
                {{Form::label('data_monthly','Datos mensuales')}}
                <span></span>
            </div>
            @if($errors->first('data_monthly'))
                <div class="errors">
                    *{{$errors->first('data_monthly')}}
                </div>
            @endif
            <div class="material-input">
                {{Form::text('value_monthly','',['id' => 'value_monthly'])}}
                {{Form::label('value_monthly','Valor mensual')}}
                <span></span>
            </div>
            @if($errors->first('value_monthly'))
                <div class="errors">
                    *{{$errors->first('value_monthly')}}
                </div>
            @endif
            <div class="material-input">
                {{Form::text('data_credit','',['id' => 'data_credit'])}}
                {{Form::label('data_credit','Data credito')}}
                <span></span>
            </div>
            @if($errors->first('data_credit'))
                <div class="errors">
                    *{{$errors->first('data_credit')}}
                </div>
            @endif
        </div>

        @if(isset($locations->name) && strtolower($locations->name)=="medellin")
            <label class="accpt-checkbox">
                <h2>Fenalco</h2>
            </label>
            <section class=" accept-radio">
                {{Form::radio('fenalco', '0', true, ['class' => 'checkbox']);}}rojo
                {{Form::radio('fenalco', '1', true, ['class' => 'checkbox']);}}amarillo
                {{Form::radio('fenalco', '2', true, ['class' => 'checkbox']);}}verde
            </section>
        @endif
        @if($errors->first('fenalco'))
            <div class="errors">
                *{{$errors->first('fenalco')}}
            </div>
        @endif

        <h2>Referencia 1</h2>

        @if($errors->first('reference'))
            <div style="margin-top: 10px" class="errors">
                *{{$errors->first('reference')}}
            </div>
        @endif

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
                    <td>{{$user->CreditRequest->name_reference}}</td>
                    <td>{{$user->CreditRequest->phone_reference}}</td>
                </tr>
                </tbody>
            </table>
        </div>


        <label class="accpt-checkbox">
            {{Form::checkbox('reference1', 1, null, ['class' => 'checkbox'])}}
            Referencia 1 confirmada
        </label>

        <h2>Referencia 2</h2>

        @if($errors->first('reference'))
            <div style="margin-top: 10px" class="errors">
                *{{$errors->first('reference')}}
            </div>
        @endif

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
                    <td>{{$user->CreditRequest->name_reference2}}</td>
                    <td>{{$user->CreditRequest->phone_reference2}}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <label class="accpt-checkbox">
            {{Form::checkbox('reference2', 1, null, ['class' => 'checkbox'])}}
            Referencia 2 confirmada
        </label>

        <h2>archivos</h2>
        @if($errors->first('files'))
            <div style="margin-top: 10px" class="errors">
                *{{$errors->first('files')}}
            </div>
        @endif
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



        @if($errors->first('accept'))
            <button class="u-button">
                Volver a intentarlo
            </button>
        @else
            <button class="u-button">
                Calcular Credito
            </button>
        @endif


        {{Form::close()}}
    </section>

@stop

@section('javascript')
    {{ HTML::script('js/credit.js'); }}
    {{ HTML::script('js/variables.js'); }}
@stop
