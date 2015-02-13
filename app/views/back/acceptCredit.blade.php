@extends('layout/front')

@section('content')
    @include('layout.notify')
    @if(Session::get('message'))

        <script>
            var notify = document.getElementById('notify');
            notify.classList.add('is-show');
            notify.classList.add('success');
            notify.querySelector('.text-notify').innerText = '{{Session::get('message')}}';
        </script>
    @endif
    @if($errors->first())
        <script>
            var notify = document.getElementById('notify');
            notify.classList.add('is-show');
            notify.classList.add('error');
            notify.querySelector('.text-notify').innerText = '{{$errors->first('data_monthly')}} {{$errors->first('value_monthly')}} {{$errors->first('data_credit')}} {{$errors->first('fenalco')}} {{$errors->first('reference')}} {{$errors->first('files')}}';
        </script>
    @endif

    <div class="Back-content">
        {{ HTML::link(URL::to('solicitud'), 'atras',array('class'=>'login-button')) }}
    </div>

    <h1>Aceptacion del credito</h1>

    <section class="acceptSection">
        <h2>datos personales</h2>
        {{Form::open(array('url'=>'showCreditRequest/'.$user->id,'method'=>'POST','class'=>""))}}
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

        <div class="input-content">
            <div class="material-input">
                {{Form::text('data_monthly','',['id' => 'data_monthly'])}}
                {{Form::label('data_monthly','Datos mensuales')}}
                <span></span>
            </div>
            <div class="material-input">
                {{Form::text('value_monthly','',['id' => 'value_monthly'])}}
                {{Form::label('value_monthly','Valor mensual')}}
                <span></span>
            </div>
            <div class="material-input">
                {{Form::text('data_credit','',['id' => 'data_credit'])}}
                {{Form::label('data_credit','Data credito')}}
                <span></span>
            </div>
        </div>
        <label class="accpt-checkbox">
            {{Form::checkbox('show', 1, null, ['class' => 'checkbox show-accept'])}}
            Fenalco
        </label>
        <section class="hidden accept-radio">
            {{Form::radio('fenalco', '0', true, ['class' => 'checkbox']);}}rojo
            {{Form::radio('fenalco', '1', true, ['class' => 'checkbox']);}}amarillo
            {{Form::radio('fenalco', '2', true, ['class' => 'checkbox']);}}verde
        </section>



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

@section('javascript')
    {{ HTML::script('js/credit.js'); }}
    {{ HTML::script('js/variables.js'); }}
@stop
