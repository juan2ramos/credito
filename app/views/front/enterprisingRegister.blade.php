@extends('layout/front')

@section('content')
    @include('partial.submenu')

    @if(Session::get('message'))
        <div style="width: calc( 100% - 30px )" id="notify" class="notify is-show success">
            <strong>Mensaje</strong>
            <span class="text-notify">{{Session::get('message')}}</span>
            <span class="close-notify">x</span>
        </div>
    @endif

    <section class="Credit u-shadow-5">
        @extends('layout/notify')

        <h1>SE UNA EMPRENDEDORA LILIPINK</h1>

        <br>
        <input class="Tab" id="tab1" type="radio" name="tabs" checked>
        <input class="Tab" id="tab2" type="radio" name="tabs">
        <label style="margin-left:-150px" class="u-button" for="tab1">Pagos de contado</label>
        <label style="" class="u-button" for="tab2">Pagos a crédito</label>
        <br>
        <article class="TabContainer" id="simpleForm">

            {{Form::open(['route'=>'enterprisingSimple','method'=>'POST','files'=>true,'class'=>"Credito-form",'enctype'=>'multipar/form-data'])}}

            <section class="Credit-section u-CreditSection">

                <div class="material-input">
                    {{Form::text('name','',['id' => 'name'])}}
                    {{Form::label('name','Nombre')}}
                    <span></span>
                </div>

                @if($errors->first('name'))
                    <div class="errors">
                        *{{$errors->first('name')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::text('last_name','',['id' => 'last_name'])}}
                    {{Form::label('last_name','Apellido')}}
                    <span></span>
                </div>

                @if($errors->first('last_name'))
                    <div class="errors">
                        *{{$errors->first('last_name')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::text('email','',['id' => 'mail'])}}
                    {{Form::label('email','Correo')}}
                    <span></span>
                </div>

                @if($errors->first('email'))
                    <div class="errors">
                        *{{$errors->first('email')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::password('password','',['id' => 'password'])}}
                    {{Form::label('password','Contraseña')}}
                    <span></span>
                </div>

                @if($errors->first('password'))
                    <div class="errors">
                        *{{$errors->first('password')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::password('password_confirm','',['id' => 'password_confirm'])}}
                    {{Form::label('password_confirm','Confirmar Contraseña')}}
                    <span></span>
                </div>

                @if($errors->first('second_last_name'))
                    <div class="errors">
                        *{{$errors->first('second_last_name')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::number('identification_card','',['id' => 'identification_card'])}}
                    {{Form::label('identification_card','Cedula')}}
                    <span></span>
                </div>

                @if($errors->first('identification_card'))
                    <div class="errors">
                        *{{$errors->first('identification_card')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::text('instead_expedition','',['id' => 'instead_expedition'])}}
                    {{Form::label('instead_expedition','Lugar de expedicion')}}
                    <span></span>
                </div>

                @if($errors->first('instead_expedition'))
                    <div class="errors">
                        *{{$errors->first('instead_expedition')}}
                    </div>
                @endif

            </section>

            <section class="Credit-section">

                <div class="material-input">
                    {{Form::input('date','date_expedition','',['id' => 'date_expedition'])}}
                    {{Form::label('date_expedition','Fecha de expedicion')}}
                    <span></span>
                </div>

                @if($errors->first('date_expedition'))
                    <div class="errors">
                        *{{$errors->first('date_expedition')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::text('residency_city','',['id' => 'residency_city'])}}
                    {{Form::label('residency_city','Ciudad de residencia')}}
                    <span></span>
                </div>

                @if($errors->first('residency_city'))
                    <div class="errors">
                        *{{$errors->first('residency_city')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::text('address','',['id' => 'address'])}}
                    {{Form::label('address','Dirección')}}
                    <span></span>
                </div>

                @if($errors->first('address'))
                    <div class="errors">
                        *{{$errors->first('address')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::text('mobile_phone','',['id' => 'mobile_phone','required'])}}
                    {{Form::label('mobile_phone','Número de celular')}}
                    <span></span>
                </div>

                @if($errors->first('mobile_phone'))
                    <div class="errors">
                        *{{$errors->first('mobile_phone')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::text('phone','',['id' => 'phone','required'])}}
                    {{Form::label('phone','Número fijo')}}
                    <span></span>
                </div>

                @if($errors->first('phone'))
                    <div class="errors">
                        *{{$errors->first('phone')}}
                    </div>
                @endif

                <div style="margin: 43px 0;">
                    <label>
                        ¿Actualmente vendes por catálogo?
                        {{Form::radio('isWorking', 1, null, ['class' => 'radio','required'])}}
                        {{Form::label('isWorking','Si')}}
                        {{Form::radio('isWorking', 2, true, ['class' => 'radio','required'])}}
                        {{Form::label('isWorking','No')}}
                    </label>
                </div>

                <div class="material-input">
                    {{Form::text('whereIsWorking','',['id' => 'phone','required'])}}
                    {{Form::label('whereIsWorking','¿Cuáles catálogos?')}}
                    <span></span>
                </div>

                @if($errors->first('whereIsWorking'))
                    <div class="errors">
                        *{{$errors->first('whereIsWorking')}}
                    </div>
                @endif

            </section>

            <div style="margin-top: 20px">
                <div class="label--checkbox">
                    <label>
                        {{Form::checkbox('remember', 1, null, ['class' => 'checkbox','required'])}}
                        - Acepto las politicas de uso del sitio de Innova Quality SAS  {{ HTML::link(URL::to('img/usoSitio.pdf'), 'descargar',array('id'=>'','target'=>'_blank')) }}<br>
                    </label>
                    <label>
                        {{Form::checkbox('remember', 1, null, ['class' => 'checkbox','required'])}}
                        - Acepto las politicas de privacidad de datos de la tarjeta recargable.  {{ HTML::link(URL::to('img/politicasTratamiento.pdf'), 'descargar',array('id'=>'','target'=>'_blank')) }}
                    </label>
                </div>
            </div>

            <button class="u-button">
                Enviar Solicitud
            </button>

            {{Form::close()}}
        </article>
        <article class="TabContainer col-12" id="creditForm">

            {{Form::open(['route'=>'enterprisingCredit','method'=>'POST','files'=>true,'class'=>"Credito-form",'enctype'=>'multipar/form-data'])}}

            <section class="Credit-section u-CreditSection">

                <div class="material-input">
                    {{Form::text('name','',['id' => 'name'])}}
                    {{Form::label('name','Nombre')}}
                    <span></span>
                </div>

                @if($errors->first('name'))
                    <div class="errors">
                        *{{$errors->first('name')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::text('last_name','',['id' => 'last_name'])}}
                    {{Form::label('last_name','Apellido')}}
                    <span></span>
                </div>

                @if($errors->first('last_name'))
                    <div class="errors">
                        *{{$errors->first('last_name')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::text('email','',['id' => 'mail'])}}
                    {{Form::label('email','Correo')}}
                    <span></span>
                </div>

                @if($errors->first('email'))
                    <div class="errors">
                        *{{$errors->first('email')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::password('password','',['id' => 'password'])}}
                    {{Form::label('password','Contraseña')}}
                    <span></span>
                </div>

                @if($errors->first('password'))
                    <div class="errors">
                        *{{$errors->first('password')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::password('password_confirm','',['id' => 'password_confirm'])}}
                    {{Form::label('password_confirm','Confirmar Contraseña')}}
                    <span></span>
                </div>

                @if($errors->first('second_last_name'))
                    <div class="errors">
                        *{{$errors->first('second_last_name')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::number('identification_card','',['id' => 'identification_card'])}}
                    {{Form::label('identification_card','Cedula')}}
                    <span></span>
                </div>

                @if($errors->first('identification_card'))
                    <div class="errors">
                        *{{$errors->first('identification_card')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::text('instead_expedition','',['id' => 'instead_expedition'])}}
                    {{Form::label('instead_expedition','Lugar de expedicion')}}
                    <span></span>
                </div>

                @if($errors->first('instead_expedition'))
                    <div class="errors">
                        *{{$errors->first('instead_expedition')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::input('date','date_expedition','',['id' => 'date_expedition'])}}
                    {{Form::label('date_expedition','Fecha de expedicion')}}
                    <span></span>
                </div>

                @if($errors->first('date_expedition'))
                    <div class="errors">
                        *{{$errors->first('date_expedition')}}
                    </div>
                @endif

            </section>

            <section class="Credit-section">

                <div class="material-input">
                    {{Form::text('residency_city','',['id' => 'residency_city'])}}
                    {{Form::label('residency_city','Ciudad de residencia')}}
                    <span></span>
                </div>

                @if($errors->first('residency_city'))
                    <div class="errors">
                        *{{$errors->first('residency_city')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::text('address','',['id' => 'address'])}}
                    {{Form::label('address','Dirección')}}
                    <span></span>
                </div>

                @if($errors->first('address'))
                    <div class="errors">
                        *{{$errors->first('address')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::text('mobile_phone','',['id' => 'mobile_phone','required'])}}
                    {{Form::label('mobile_phone','Número de celular')}}
                    <span></span>
                </div>

                @if($errors->first('mobile_phone'))
                    <div class="errors">
                        *{{$errors->first('mobile_phone')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::text('phone','',['id' => 'phone','required'])}}
                    {{Form::label('phone','Número fijo')}}
                    <span></span>
                </div>

                @if($errors->first('phone'))
                    <div class="errors">
                        *{{$errors->first('phone')}}
                    </div>
                @endif

                <div>
                    <label>
                        ¿Actualmente vendes por catálogo?
                        {{Form::radio('isWorking', 1, null, ['class' => 'radio','required'])}}
                        {{Form::label('isWorking','Si')}}
                        {{Form::radio('isWorking', 2, true, ['class' => 'radio','required'])}}
                        {{Form::label('isWorking','No')}}
                    </label>
                </div>

                <div class="material-input">
                    {{Form::text('whereIsWorking','',['id' => 'phone','required'])}}
                    {{Form::label('whereIsWorking','¿Cuáles catálogos?')}}
                    <span></span>
                </div>

                @if($errors->first('whereIsWorking'))
                    <div class="errors">
                        *{{$errors->first('whereIsWorking')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::text('monthly_income','',['id' => 'monthly_income'])}}
                    {{Form::label('monthly_income','Ingresos mensuales')}}
                    <span></span>
                </div>

                @if($errors->first('monthly_income'))
                    <div class="errors">
                        *{{$errors->first('monthly_income')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::text('monthly_expenses','',['id' => 'monthly_expenses'])}}
                    {{Form::label('monthly_expenses','Egresos mensuales')}}
                    <span></span>
                </div>

                @if($errors->first('monthly_expenses'))
                    <div class="errors">
                        *{{$errors->first('monthly_expenses')}}
                    </div>
                @endif

            </section>

            <section class="Credit-section u-CreditSection">
                <div class="material-input">
                    <div>
                        {{ Form::select('location', $locations,'',array('class'=>'Credit-select','id'=>'location')) }}
                        <span></span>
                    </div>

                    @if($errors->first('location'))
                        <div class="errors">
                            *{{$errors->first('location')}}
                        </div>
                    @endif
                </div>
            </section>

            <section class="Credit-section">
                <div class="material-input">
                    <select class="Credit-select" name="point" id="point">
                        <option value="" selected="selected">seleccione un punto de venta</option>
                        @foreach ($points as $point)
                            <option data-city="{{$point['location_id']}}" value="{{$point['id']}}">{{$point['name']}}</option>
                        @endforeach
                    </select>
                    <span></span>
                </div>

                @if($errors->first('point'))
                    <div class="errors">
                        *{{$errors->first('point')}}
                    </div>
                @endif
            </section>

            <section class="Credit-section u-CreditSection">

                <p class="titleReference">Referencia Personal 1</p>

                <div class="material-input">
                    {{Form::text('name_reference','',['id' => 'name_reference'])}}
                    {{Form::label('Name_reference','Nombre')}}
                    <span></span>
                </div>

                @if($errors->first('name_reference'))
                    <div class="errors">
                        *{{$errors->first('name_reference')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::text('phone_reference','',['id' => 'phone_reference'])}}
                    {{Form::label('phone_reference','Telefono')}}
                    <span></span>
                </div>

                @if($errors->first('phone_reference'))
                    <div class="errors">
                        *{{$errors->first('phone_reference')}}
                    </div>
                @endif
            </section>
            <section class="Credit-section">
                <p class="titleReference">Referencia Personal 2</p>

                <div class="material-input">
                    {{Form::text('name_reference2','',['id' => 'name_reference2'])}}
                    {{Form::label('Name_reference2','Nombre')}}
                    <span></span>
                </div>

                @if($errors->first('name_reference2'))
                    <div class="errors">
                        *{{$errors->first('name_reference2')}}
                    </div>
                @endif

                <div class="material-input">
                    {{Form::text('phone_reference2','',['id' => 'phone_reference2'])}}
                    {{Form::label('phone_reference2','Telefono')}}
                    <span></span>
                </div>

                @if($errors->first('phone_reference2'))
                    <div class="errors">
                        *{{$errors->first('phone_reference2')}}
                    </div>
                @endif
            </section>

            <div class="hidden">
                {{Form::text('files','',['id'=>'form-files'])}}
            </div>

            <div style="margin:40px 0" class="files-container">
                <div class="pop-up ">
                    <p>Sube tus documentos <br>
                        <span>Fotocopia de la cedula 150%</span>
                    </p>

                    {{ HTML::image('img/image-file.svg','', array ('id' => 'image-file')) }}
                    {{Form::file('file[]',array('id'=>'files','name'=>'file[]','multiple'))}}
                </div>
                <!--<div class="material-item fingerprint" style="width: 221px;">
                    <div id="dropzone">
                        <div>HUELLA</div>
                        form::file('finger', ['name' => 'finger','accept' => 'image/jpeg, image/png'])
                    </div>
                </div> -->
            </div>
            <div>
                <div class="request-image" style="display: inline-block"></div>
                <div style="display: inline-block;vertical-align: top">
                    <div class="preload hidden "  >
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>

            </div>

            @if($errors->first('files'))
                <div class="errors">
                    *Los archivos son obligatorios
                </div>
            @endif

            <div>
                <div class="label--checkbox">
                    <label>
                        {{Form::checkbox('remember', 1, null, ['class' => 'checkbox','required'])}}
                        - Acepto las politicas de uso del sitio de Innova Quality SAS  {{ HTML::link(URL::to('img/usoSitio.pdf'), 'descargar',array('id'=>'','target'=>'_blank')) }}<br>
                    </label>
                    <label>
                        {{Form::checkbox('remember', 1, null, ['class' => 'checkbox','required'])}}
                        - Acepto las politicas de privacidad de datos de la tarjeta recargable.  {{ HTML::link(URL::to('img/politicasTratamiento.pdf'), 'descargar',array('id'=>'','target'=>'_blank')) }}
                    </label>
                </div>
            </div>

            <button class="u-button">
                Enviar Solicitud
            </button>

            {{Form::close()}}

        </article>
    </section>
@stop

@section('javascript')
    {{ HTML::script('js/credit.js'); }}

    <script>
        $('#dropzone input').on('change', function(e) {
            var file = this.files[0];

            if (this.accept && $.inArray(file.type, this.accept.split(/, ?/)) == -1) {
                return alert('Tipo de archivo no permitido.');
            }

            $('#dropzone img').remove();
            if ((/^image\/(gif|png|jpeg)$/i).test(file.type)) {
                var reader = new FileReader(file);
                reader.readAsDataURL(file);
                reader.onload = function(e) {
                var data = e.target.result,
                    $img = $('<img />').attr('src', data).fadeIn();
                    $('#dropzone div').html($img);
                };
            } else {
                var ext = file.name.split('.').pop();
                $('#dropzone div').html(ext);
            }
        });

        $('.close-notify').on('click', function(){
            $(this).parent().slideToggle();
        });
    </script>
@stop

@section('styles')
    <style>
        .TabContainer{
        width: 100%;
        transition: all 1s ease;
        display: none}

        .Tab{
        background: #fff;
        padding: 22px;
        cursor: pointer;
        font-weight: 400;}

        [for^="tab"]{
        color: #D9D9D9}

        #tab1:checked ~ [for="tab1"],
        #tab2:checked ~ [for="tab2"]{
        opacity: 1}

        #tab1:checked ~ #simpleForm,
        #tab2:checked ~ #creditForm
        {
        display: block
        }

        input.Tab{
        display: none}

        label.u-button{
            color: #fff;
            width: 200px;
            text-align: center;
            background: #BA007C;
            opacity: .3;
            margin-right: 10px;
            position: relative;
            left: 50%;
            font-size: 1rem;
        }
    </style>
@stop