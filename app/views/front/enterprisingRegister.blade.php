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


        <h2 class="title">SE UNA EMPRENDEDORA LILIPINK</h2>
        <span class="subtitle" id="subtitle">
            @if(Input::old('isCredit'))
                FORMULARIO DE CREDITO
            @else
                FORMULARIO DE CONTADO
            @endif
        </span>

        <article class="Container col-12">
            <form action="{{route('enterprisingRegister')}}" method="POST" accept-charset="UTF-8" class="Credito-form"
                  enctype="multipart/form-data">
                <!--<span style="text-align:center; color:#b9007d; display: block; padding: 20px 5px">El crédito lilipink emprendedora, difiere tus pedidos y compras a una sola cuota - para pago a 15 días después de la fecha de facturación.</span>-->
                <section class="Credit-section u-CreditSection">
                    <div class="material-input">
                        {{Form::text('name',Input::old('name'),['id' => 'name'])}}
                        {{Form::label('name','Nombre')}}
                        <span></span>
                    </div>

                    @if($errors->first('name'))
                        <div class="errors">
                            *{{$errors->first('name')}}
                        </div>
                    @endif

                    <div class="material-input">
                        {{Form::text('last_name',Input::old('last_name'),['id' => 'last_name'])}}
                        {{Form::label('last_name','Apellido')}}
                        <span></span>
                    </div>

                    @if($errors->first('last_name'))
                        <div class="errors">
                            *{{$errors->first('last_name')}}
                        </div>
                    @endif

                    <div class="material-input">
                        {{Form::text('email',Input::old('email'),['id' => 'mail'])}}
                        {{Form::label('email','Correo')}}
                        <span></span>
                    </div>

                    @if($errors->first('email'))
                        <div class="errors">
                            *{{$errors->first('email')}}
                        </div>
                    @endif

                    <div class="material-input">
                        {{Form::number('identification_card',Input::old('identification_card'),['id' => 'identification_card'])}}
                        {{Form::label('identification_card','Cedula')}}
                        <span></span>
                    </div>

                    @if($errors->first('identification_card'))
                        <div class="errors">
                            *Ya estas registrada en creditos Lilipink, comunicate con
                            emprendedoras@innova-quality.com.co
                        </div>
                    @endif

                    <div class="material-input">
                        {{Form::text('instead_expedition',Input::old('instead_expedition'),['id' => 'instead_expedition'])}}
                        {{Form::label('instead_expedition','Lugar de expedicion')}}
                        <span></span>
                    </div>

                    @if($errors->first('instead_expedition'))
                        <div class="errors">
                            *{{$errors->first('instead_expedition')}}
                        </div>
                    @endif

                    <div class="material-input">
                        {{Form::input('date','date_expedition',Input::old('date_expedition'),['id' => 'date_expedition'])}}
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
                        {{Form::text('residency_city',Input::old('residency_city'),['id' => 'residency_city'])}}
                        {{Form::label('residency_city','Ciudad de residencia')}}
                        <span></span>
                    </div>

                    @if($errors->first('residency_city'))
                        <div class="errors">
                            *{{$errors->first('residency_city')}}
                        </div>
                    @endif

                    <div class="material-input">
                        {{Form::text('address',Input::old('address'),['id' => 'address'])}}
                        {{Form::label('address','Dirección')}}
                        <span></span>
                    </div>

                    @if($errors->first('address'))
                        <div class="errors">
                            *{{$errors->first('address')}}
                        </div>
                    @endif

                    <div class="material-input">
                        {{Form::number('mobile_phone', Input::old('mobile_phone'))}}
                        {{Form::label('mobile_phone','Número de celular')}}
                        <span></span>
                    </div>

                    @if($errors->first('mobile_phone'))
                        <div class="errors">
                            *{{$errors->first('mobile_phone')}}
                        </div>
                    @endif

                    <div class="material-input">
                        {{Form::text('phone',Input::old('phone'))}}
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
                            <input type="radio" value="1" name="isWorking" id="isWorking" class="radio"
                                   @if(count($errors) && Input::old('isWorking') == 1) checked="checked" @endif >
                            <label for="isWorking">Si</label>
                            <input type="radio" value="0" name="isWorking" id="isWorking" class="radio"
                                   @if(!count($errors) || Input::old('isWorking') == 0) checked="checked" @endif >
                            <label for="isWorking">No</label>
                        </label>
                    </div>

                    <div class="material-input whereIsWorking"
                         @if(!count($errors) || Input::old('isWorking') == 0) style="display:none" @endif >
                        {{Form::text('whereIsWorking', Input::old('whereIsWorking'),['id' => 'whereIsWorking'])}}
                        {{Form::label('whereIsWorking','¿Cuáles catálogos?')}}
                        <span></span>
                    </div>

                    @if($errors->first('whereIsWorking'))
                        <div class="errors">
                            *{{$errors->first('whereIsWorking')}}
                        </div>
                    @endif

                </section>

                <section class="Credit-section u-CreditSection">
                    <div class="material-input">
                        {{Form::text('referred_name',Input::old('referred_name'),['id' => 'referred_name'])}}
                        {{Form::label('referred_name','Nombre de quien refiere (Opcional)')}}
                        <span></span>
                    </div>

                    @if($errors->first('referred_name'))
                        <div class="errors">
                            *{{$errors->first('referred_name')}}
                        </div>
                    @endif
                </section>

                <section class="Credit-section">
                    <div class="material-input">
                        {{Form::number('referred_document',Input::old('referred_document'),['id' => 'referred_document'])}}
                        {{Form::label('referred_document','Cedula de quien refiere (Opcional)')}}
                        <span></span>
                    </div>

                    @if($errors->first('referred_document'))
                        <div class="errors">
                            *{{$errors->first('referred_document')}}
                        </div>
                    @endif
                </section>


                <div id="CreditEnterprisingForm" @if(!count($errors) || !Input::old('isCredit')) class="hidden" @endif>
                    <section class="Credit-section u-CreditSection">
                        <div class="material-input">
                            {{Form::text('monthly_income',Input::old('monthly_income'),['id' => 'monthly_income'])}}
                            {{Form::label('monthly_income','Ingresos mensuales')}}
                            <span></span>
                        </div>

                        @if($errors->first('monthly_income'))
                            <div class="errors">
                                *{{$errors->first('monthly_income')}}
                            </div>
                        @endif
                    </section>

                    <section class="Credit-section">
                        <div class="material-input">
                            {{Form::text('monthly_expenses',Input::old('monthly_expenses'),['id' => 'monthly_expenses'])}}
                            {{Form::label('monthly_expenses','Egresos mensuales')}}
                            <span></span>
                        </div>

                        @if($errors->first('monthly_expenses'))
                            <div class="errors">
                                *{{$errors->first('monthly_expenses')}}
                            </div>
                        @endif
                    </section>

                    <span style="text-align:center; color:#b9007d; display: block; padding: 20px 5px;">SELECCIONA UNA TIENDA CERCA A TI PARA RECLAMAR TU TARJETA LILIPINK EN 15 DÍAS.</span>
                    <section class="Credit-section u-CreditSection" style="margin-bottom: 0 !important">
                        <div>
                            <div style="margin: 0;" class="material-input">
                                <select name="location" id="location" class="Credit-select">
                                    <option value="3" @if(Input::old('location') == '3') selected @endif >Bogota -
                                        Cundinamarca
                                    </option>
                                    {{-- @foreach($locations as $key => $location)
                                         <option value="{{$key}}" @if(Input::old('location') == $key) selected @endif >{{$location}}</option>
                                    @endforeach--}}
                                </select>
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
                        <div style="margin: 0;" class="material-input">
                            <select class="Credit-select" name="point" id="shop">
                                <option data-city="3" style="" value="43">Intima Lili Pink Toberín - Calle 164 No.
                                    20-08
                                </option>
                                {{-- <option value="" selected="selected">seleccione un punto de venta</option>
                                @foreach ($points as $point)
                                    <option data-city="{{$point['location_id']}}" style="display:none" value="{{$point['point_id']}}" @if(Input::old('point') == $point['point_id']) selected @endif >{{$point['point_name']}}</option>
                                @endforeach--}}
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
                            {{Form::text('name_reference',Input::old('name_reference'),['id' => 'name_reference'])}}
                            {{Form::label('Name_reference','Nombre')}}
                            <span></span>
                        </div>

                        @if($errors->first('name_reference'))
                            <div class="errors">
                                *{{$errors->first('name_reference')}}
                            </div>
                        @endif

                        <div class="material-input">
                            {{Form::text('phone_reference',Input::old('phone_reference'),['id' => 'phone_reference'])}}
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
                            {{Form::text('name_reference2',Input::old('name_reference2'),['id' => 'name_reference2'])}}
                            {{Form::label('Name_reference2','Nombre')}}
                            <span></span>
                        </div>

                        @if($errors->first('name_reference2'))
                            <div class="errors">
                                *{{$errors->first('name_reference2')}}
                            </div>
                        @endif

                        <div class="material-input">
                            {{Form::text('phone_reference2',Input::old('phone_reference2'),['id' => 'phone_reference2'])}}
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

                    <div style="margin:20px 0" class="files-container">
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
                            <div class="preload hidden ">
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
                </div>

                <div>
                     <label class="label--checkbox">
                {{Form::checkbox('remember', 1, null, ['class' => 'checkbox','required'])}}
                - Acepto las politicas de uso del sitio de PINK LIFE SAS {{ HTML::link(URL::to('img/politicas-creditos-lilipink.pdf'), 'descargar',array('id'=>'','target'=>'_blank')) }}<br>
                {{Form::checkbox('remember', 1, null, ['class' => 'checkbox','required'])}}
                - Acepto las politicas de privacidad de datos {{ HTML::link(URL::to('img/politicas-datos-creditos-lilipink.pdf'), 'descargar',array('id'=>'','target'=>'_blank')) }}
            </label>
                </div>
                <div id="backButton">
                    @if(Input::old('isCredit'))
                        <a href="#" class="u-button" style="margin: auto; display: inline-block; text-align: center;"
                           onclick="return false">VOLVER AL FORMULARIO DE CONTADO</a>
                        <span style="display: block; text-align: center; padding: 10px 5px;">COMO EMPRENDEDORA DE CONTADO, EL PAGO DE LOS PEDIDOS SON ANTICIPADOS POR EFECTY O BANCOLOMBIA.</span>
                        <input type="hidden" id="isCredit" name="isCredit" value="true">
                    @else
                        {{--<a href="#" class="u-button" style="margin: auto; display: inline-block; text-align: center;"--}}
                        {{--onclick="return false">SOLICITA AQUI CRÉDITO COMO EMPRENDEDORA - SIN CODEUDORES</a>--}}
                        {{--<span style="display: block; text-align: center; padding: 10px 5px;">CON EL CRÉDITO EMPRENDEDORA TUS COMPRAS EN TIENDA O PEDIDOS EN LINEA SE DIFIEREN A 1 CUOTA PARA PAGO A LOS 15 DIAS EN NUESTRAS TIENDAS LILI PINK EMPRENDEDORAS.</span>--}}
                    @endif
                </div>
                <div id="sendButton">
                    @if(Input::old('isCredit'))
                        <button class="u-button">ENVIAR SOLICITUD COMO EMPRENDEDORA A CRÉDITO - SIN CODEUDORES</button>
                        <span style="display: block; text-align: center; padding: 20px 5px;">CON EL CRÉDITO EMPRENDEDORA TUS COMPRAS EN TIENDA O PEDIDOS EN LINEA SE DIFIEREN A 1 CUOTA PARA PAGO A LOS 15 DIAS EN NUESTRAS TIENDAS LILI PINK EMPRENDEDORAS.</span>
                    @else
                        <button class="u-button">ENVIAR SOLICITUD COMO EMPRENDEDORA CONTADO</button>
                        <span style="display: block; text-align: center; padding: 20px 5px;">COMO EMPRENDEDORA DE CONTADO, EL PAGO DE LOS PEDIDOS SON ANTICIPADOS POR EFECTY O BANCOLOMBIA.</span>
                    @endif
                </div>
            </form>
        </article>
    </section>
@stop

@section('javascript')
    {{ HTML::script('js/credit.js'); }}

    <script>

        $('#backButton').on('click', 'a', function () {
            var creditForm = $('#CreditEnterprisingForm'),
                subtitle = $('#subtitle'),
                backButton = $(this),
                backButtonSpan = backButton.siblings('span'),
                sendButton = $('#sendButton').children('button'),
                sendButtonSpan = sendButton.siblings('span');
            creditForm.toggleClass('hidden');


            if (creditForm.hasClass('hidden')) {
                subtitle.text('FORMULARIO DE CONTADO');
                backButton.text('SOLICITA AQUI CRÉDITO COMO EMPRENDEDORA - SIN CODEUDORES');
                backButtonSpan.text('CON EL CRÉDITO EMPRENDEDORA TUS COMPRAS EN TIENDA O PEDIDOS EN LINEA SE DIFIEREN A 1 CUOTA PARA PAGO A LOS 15 DIAS EN NUESTRAS TIENDAS LILI PINK EMPRENDEDORAS.');
                sendButton.text('ENVIAR SOLICITUD COMO EMPRENDEDORA CONTADO');
                sendButtonSpan.text('COMO EMPRENDEDORA DE CONTADO, EL PAGO DE LOS PEDIDOS SON ANTICIPADOS POR EFECTY O BANCOLOMBIA.');
                $('#isCredit').remove();
            } else {
                subtitle.text('FORMULARIO A CRÉDITO');
                backButton.text('VOLVER AL FORMULARIO DE CONTADO');
                backButtonSpan.text('COMO EMPRENDEDORA DE CONTADO, EL PAGO DE LOS PEDIDOS SON ANTICIPADOS POR EFECTY O BANCOLOMBIA.');
                sendButton.text('ENVIAR SOLICITUD COMO EMPRENDEDORA A CRÉDITO - SIN CODEUDORES');
                sendButtonSpan.text('CON EL CRÉDITO EMPRENDEDORA TUS COMPRAS EN TIENDA O PEDIDOS EN LINEA SE DIFIEREN A 1 CUOTA PARA PAGO A LOS 15 DIAS EN NUESTRAS TIENDAS LILI PINK EMPRENDEDORAS.');
                creditForm.append('<input type="hidden" id="isCredit" name="isCredit" value="true">');
            }

            $('html, body').animate({scrollTop: 0}, 500);
        });


        $('#location').on('change', function () {
            var city = $(this).find(":selected").val();
            var options = $('#shop').children('option');
            for (var i = 1; i < options.length; i++) {
                var option = options.eq(i);
                if (option.attr('data-city') == city) {
                    option.show();
                }
                else {
                    option.removeAttr('selected');
                    option.hide();
                }
            }
            options.eq(0).attr('selected', 'selected');
        });
        $('#dropzone input').on('change', function (e) {
            var file = this.files[0];

            if (this.accept && $.inArray(file.type, this.accept.split(/, ?/)) == -1) {
                return alert('Tipo de archivo no permitido.');
            }

            $('#dropzone img').remove();
            if ((/^image\/(gif|png|jpeg)$/i).test(file.type)) {
                var reader = new FileReader(file);
                reader.readAsDataURL(file);
                reader.onload = function (e) {
                    var data = e.target.result,
                        $img = $('<img />').attr('src', data).fadeIn();
                    $('#dropzone div').html($img);
                };
            } else {
                var ext = file.name.split('.').pop();
                $('#dropzone div').html(ext);
            }
        });

        $('.close-notify').on('click', function () {
            $(this).parent().slideToggle();
        });

        $('[name="isWorking"]').on('change', function () {
            var whereIsWorking = $(this).parent().parent().siblings('.whereIsWorking');
            $(this).val() > 0 ? whereIsWorking.show() : whereIsWorking.hide();
        });
    </script>
@stop
