@extends('layout/front')
@section('title') Solicitud de Credito @stop
@section('content')
    {{ Session::get('mensaje') }}

    <section class="Credit u-shadow-5">
        @extends('layout/notify')

        <h1>Solicitud de credito</h1>

        {{Form::open(array('url'=>'credito','method'=>'POST','files'=>true,'class'=>"Credito-form",'enctype'=>'multipar/form-data'))}}

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
                {{ Form::select('location', $locations,'',array('class'=>'Credit-select','id'=>'location')) }}
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
            <label class="label--checkbox">
                {{Form::checkbox('remember', 1, null, ['class' => 'checkbox','required'])}}
                - Acepto las politicas de uso del sitio de Innova Quality SAS  {{ HTML::link(URL::to('img/usoSitio.pdf'), 'descargar',array('id'=>'','target'=>'_blank')) }}<br>
                {{Form::checkbox('remember', 1, null, ['class' => 'checkbox','required'])}}
                - Acepto las politicas de privacidad de datos de la tarjeta recargable.  {{ HTML::link(URL::to('img/politicasTratamiento.pdf'), 'descargar',array('id'=>'','target'=>'_blank')) }}
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
        $(function() {
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
        });
    </script>
@stop