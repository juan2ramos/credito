@extends('layout/front')
@section('title') Solicitud de Credito @stop
@section('content')
    {{ Session::get('mensaje') }}

    <section class="Credit u-shadow-5">
        @extends('layout/notify')

        <h1>Solicitud de credito</h1>

        {{Form::open(array('route'=>'credit','method'=>'POST','files'=>true,'class'=>"Credito-form",'enctype'=>'multipar/form-data'))}}

        <section class="Credit-section u-CreditSection">

            <div class="material-input">
                {{ Form::select('document_type', $type,'',array('class'=>'Credit-select')) }}
                <span></span>
            </div>

            @if($errors->first('document_type'))
                <div class="errors">
                    *{{$errors->first('document_type')}}
                </div>
            @endif

            <div class="material-input">
                {{Form::text('identification_card','',['id' => 'identification_card'])}}
                {{Form::label('identification_card','Cedula')}}
                <span></span>
            </div>

            @if($errors->first('identification_card'))
                <div class="errors">
                    *{{$errors->first('identification_card')}}
                </div>
            @endif
            <div>
                <div style="width: 49%;display: inline-block">
                    <div class="material-input" style="margin: 0">
                        {{Form::text('correo','',['id' => 'bMail'])}}
                        {{Form::hidden('email','',['id' => 'email'])}}
                        {{Form::label('bMail','Correo')}}
                        <span></span>
                    </div>
                </div>
                <span>@</span>
                <select style="width: 45%;vertical-align: bottom; margin: 0" id="aMail" class="">
                    <option value="0">seleccione correo</option>
                    <option value="gmail.com">gmail.com</option>
                    <option value="hotmail.com">hotmail.com</option>
                    <option value="mail.com">mail.com</option>
                    <option value="outlook.com">outlook.com</option>
                    <option value="yahoo.es">yahoo.es</option>
                    <option value="yahoo.com">yahoo.com</option>
                    <option value="otro">otro</option>
                </select>
                {{Form::text('','',['id' => 'aMailText',
                'style' => 'width: 45%; display:none;margin: 10px 0; float: right;',
                'placeholder' => 'ejemplo.com'
                ])}}
            </div>

            @if($errors->first('email'))
                <div class="errors" style="margin-top: 6px">
                    *{{$errors->first('email')}}
                </div>
            @endif

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
                {{Form::text('second_name','',['id' => 'second_name'])}}
                {{Form::label('second_name','Segundo nombre')}}
                <span></span>
            </div>

            @if($errors->first('second_name'))
                <div class="errors">
                    *{{$errors->first('second_name')}}
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
                {{Form::text('second_last_name','',['id' => 'second_last_name'])}}
                {{Form::label('second_last_name','Segundo apellido')}}
                <span></span>
            </div>

            @if($errors->first('second_last_name'))
                <div class="errors">
                    *{{$errors->first('second_last_name')}}
                </div>
            @endif

            <div class="material-input">
                {{Form::text('birth_city','',['id' => 'birth_city'])}}
                {{Form::label('birth_city','Ciudad de nacimiento')}}
                <span></span>
            </div>

            @if($errors->first('birth_city'))
                <div class="errors">
                    *{{$errors->first('birth_city')}}
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
                <select name="location" id="location" class="Credit-select">
                    @foreach($locations as  $key => $location)
                        <option value="{{$key}}">{{$location}}</option>
                    @endforeach
                </select>
                <span></span>
            </div>

            @if($errors->first('location'))
                <div class="errors">
                    *{{$errors->first('location')}}
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
                {{Form::input('date','date_birth','',['id' => 'date_birth'])}}
                {{Form::label('date_birth','Fecha de nacimiento')}}
                <span></span>
            </div>

            @if($errors->first('date_birth'))
                <div class="errors">
                    *{{$errors->first('date_birth')}}
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
            {{Form::hidden('address','',['id' => 'address'])}}
            <div class="Address-format">


                {{Form::label('address','Dirección')}}
                <span>los campos que no necesite los puede dejar en blanco</span>
                <select>
                    <option value="?" selected="selected"></option>
                    <option label="Avenida" value="AV">AV</option>
                    <option label="Avenida calle" value="AC">AC</option>
                    <option label="Autopista" value="AUTO">AUTO</option>
                    <option label="Avenida carrera" value="AK">AK</option>
                    <option label="Calle" value="CL">CL</option>
                    <option label="Carrera" value="KR">KR</option>
                    <option label="Circunvalar" value="CIR">CIR</option>
                    <option label="Diagonal" value="DG">DG</option>
                    <option label="Transversal" value="TV">TV</option>
                </select>
                <input type="text">
                <select>
                    <option value="" class="" selected="selected">-</option>
                    <option label="A" value="A">A</option>
                    <option label="B" value="B">B</option>
                    <option label="C" value="C">C</option>
                    <option label="D" value="D">D</option>
                    <option label="E" value="E">E</option>
                    <option label="F" value="F">F</option>
                    <option label="G" value="G">G</option>
                    <option label="H" value="H">H</option>
                    <option label="I" value="I">I</option>
                    <option label="J" value="J">J</option>
                    <option label="K" value="K">K</option>
                    <option label="L" value="L">L</option>
                    <option label="M" value="M">M</option>
                    <option label="N" value="N">N</option>
                    <option label="O" value="O">O</option>
                    <option label="P" value="P">P</option>
                    <option label="Q" value="Q">Q</option>
                    <option label="R" value="R">R</option>
                    <option label="S" value="S">S</option>
                    <option label="T" value="T">T</option>
                    <option label="U" value="U">U</option>
                    <option label="V" value="V">V</option>
                    <option label="W" value="W">W</option>
                    <option label="X" value="X">X</option>
                    <option label="Y" value="Y">Y</option>
                    <option label="Z" value="Z">Z</option>
                </select>
                <select>
                    <option value="" class="" selected="selected">-</option>
                    <option label="BIS" value="BIS">BIS</option>
                </select>
                <select>
                    <option value="" class="" selected="selected">-</option>
                    <option label="A" value="A">A</option>
                    <option label="B" value="B">B</option>
                    <option label="C" value="C">C</option>
                    <option label="D" value="D">D</option>
                    <option label="E" value="E">E</option>
                    <option label="F" value="F">F</option>
                    <option label="G" value="G">G</option>
                    <option label="H" value="H">H</option>
                    <option label="I" value="I">I</option>
                    <option label="J" value="J">J</option>
                    <option label="K" value="K">K</option>
                    <option label="L" value="L">L</option>
                    <option label="M" value="M">M</option>
                    <option label="N" value="N">N</option>
                    <option label="O" value="O">O</option>
                    <option label="P" value="P">P</option>
                    <option label="Q" value="Q">Q</option>
                    <option label="R" value="R">R</option>
                    <option label="S" value="S">S</option>
                    <option label="T" value="T">T</option>
                    <option label="U" value="U">U</option>
                    <option label="V" value="V">V</option>
                    <option label="W" value="W">W</option>
                    <option label="X" value="X">X</option>
                    <option label="Y" value="Y">Y</option>
                    <option label="Z" value="Z">Z</option>
                </select>
                <select>
                    <option value="" class="" selected="selected">-</option>
                    <option label="SUR" value="S">S</option>
                    <option label="ESTE" value="E">E</option>
                    <option label="OCCIDENTE" value="OCCIDENTE">W</option>
                </select>
                #
                <input type="text">
                <select data-toggle="tooltip" data-placement="top" title="Letra vía general" ng-model="letraViaGen"
                        ng-options="letra.desc for letra in letras track by letra.cod" ng-change="cambioDir()"
                        class="ng-pristine ng-untouched ng-valid ng-empty">
                    <option value="" class="" selected="selected">-</option>
                    <option label="A" value="A">A</option>
                    <option label="B" value="B">B</option>
                    <option label="C" value="C">C</option>
                    <option label="D" value="D">D</option>
                    <option label="E" value="E">E</option>
                    <option label="F" value="F">F</option>
                    <option label="G" value="G">G</option>
                    <option label="H" value="H">H</option>
                    <option label="I" value="I">I</option>
                    <option label="J" value="J">J</option>
                    <option label="K" value="K">K</option>
                    <option label="L" value="L">L</option>
                    <option label="M" value="M">M</option>
                    <option label="N" value="N">N</option>
                    <option label="O" value="O">O</option>
                    <option label="P" value="P">P</option>
                    <option label="Q" value="Q">Q</option>
                    <option label="R" value="R">R</option>
                    <option label="S" value="S">S</option>
                    <option label="T" value="T">T</option>
                    <option label="U" value="U">U</option>
                    <option label="V" value="V">V</option>
                    <option label="W" value="W">W</option>
                    <option label="X" value="X">X</option>
                    <option label="Y" value="Y">Y</option>
                    <option label="Z" value="Z">Z</option>
                </select>
                <input type="text">
                <select>
                    <option value="" class="" selected="selected">-</option>
                    <option label="SUR" value="S">S</option>
                    <option label="ESTE" value="E">E</option>
                    <option label="OCCIDENTE" value="OCCIDENTE">W</option>
                </select>
                <select >
                    <option value="" class="" selected="selected">-</option>

                    <option label="CONJUNTO" value="CONJ">CONJ</option>
                    <option label="MANZANA" value="MZ">MZ</option>
                    <option label="VEREDA" value="VDA">VEREDA</option>
                </select>
                <input type="text" style="width: 100px">
                <select >
                    <option value="" class="" selected="selected">-</option>
                    <option label="BLOQUE" value="BLQ">BLQ</option>
                    <option label="CASA" value="CS">CS</option>
                    <option label="EDIFICIO" value="ED">ED</option>
                    <option label="INTERIOR" value="INT">INT</option>
                    <option label="TORRE" value="TRR">TRR</option>
                </select>
                <input type="text" style="width: 100px">
                <select >
                    <option value="" class="" selected="selected">-</option>
                    <option label="APTO" value="APTO">APTO</option>
                    <option label="OFICINA" value="OFC">OFC</option>
                </select>
                <input type="text" style="width: 100px">
                <p id="addressShow"></p>
            </div>
            @if($errors->first('address'))
                <div class="errors">
                    *{{$errors->first('address')}}
                </div>
            @endif

            <div class="material-input">
                {{Form::text('office_address','',['id' => 'office_address'])}}
                {{Form::label('office_address','Direción de la oficina')}}
                <span></span>
            </div>

            @if($errors->first('office_address'))
                <div class="errors">
                    *{{$errors->first('office_address')}}
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

            <div class="material-input">
                <select class="Credit-select" name="point" id="point">
                    <option data-city="0" value="" selected="selected">Seleccione un punto de venta</option>
                    @foreach ($points as $point)
                        <option data-city="{{$point['location_id']}}"
                                value="{{$point['id']}}">{{$point['name']}}</option>
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

        <p class="titleReference">Referencia Personal2</p>

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

        <div class="hidden">
            {{Form::text('files','',['id'=>'form-files'])}}
        </div>

        <div class="files-container">
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

        <div>
            <label class="label--checkbox">
                {{Form::checkbox('remember', 1, null, ['class' => 'checkbox','required'])}}
                - Acepto las politicas de uso del sitio de Innova Quality
                SAS {{ HTML::link(URL::to('img/usoSitio.pdf'), 'descargar',array('id'=>'','target'=>'_blank')) }}<br>
                {{Form::checkbox('remember', 1, null, ['class' => 'checkbox','required'])}}
                - Acepto las politicas de privacidad de datos de la tarjeta
                recargable. {{ HTML::link(URL::to('img/politicasTratamiento.pdf'), 'descargar',array('id'=>'','target'=>'_blank')) }}
            </label>
        </div>


        <button class="u-button">
            Enviar Solicitud
        </button>

        {{Form::close()}}
    </section>

@stop

@section('javascript')
    {{ HTML::script('js/credit.js'); }}
    <script>
        $('#bMail, #aMail, #aMailText').on('change', function () {
            if ($('#aMail').val() == 'otro') {
                $('#aMailText').show('slow');
                $('#email').val($('#bMail').val() + '@' + $('#aMailText').val());
            } else {
                $('#aMailText').hide('slow');
                $('#email').val($('#bMail').val() + '@' + $('#aMail').val());
            }
            console.log($('#email').val());
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
        $('.Address-format input,.Address-format select').on('change', function(){
            var str = ""
            $('.Address-format').children('input,select').each(function () {
                str += $(this).val() + ' '
            });
            $('#addressShow').text(str);
            $('#address').val(str);
        })
    </script>
@stop