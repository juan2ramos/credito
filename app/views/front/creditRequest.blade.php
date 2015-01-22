@extends('layout/front')
@section('title') Solicitud de Credito @stop
@section('content')
    {{$errors->first('document_type')}}
    {{$errors->first('identification_card')}}
    {{$errors->first('name')}}
    {{$errors->first('second_name')}}
    {{$errors->first('last_name')}}
    {{$errors->first('second_last_name')}}
    {{$errors->first('address')}}
    {{$errors->first('residency_city')}}
    {{$errors->first('birth_city')}}
    {{$errors->first('date_birth')}}
    {{$errors->first('phone')}}
    {{$errors->first('mobile_phone')}}
    {{$errors->first('birth_city')}}
    {{$errors->first('instead_expedition')}}
    {{$errors->first('office_address')}}
    {{$errors->first('monthly_income')}}
    {{$errors->first('monthly_expenses')}}
    {{$errors->first('name_reference')}}
    {{$errors->first('phone_reference')}}
    {{$errors->first('phone_reference2')}}
    {{$errors->first('phone_reference2')}}
    {{$errors->first('name_reference2')}}

    {{$errors->first('files')}}


    <section class="Credito u-shadow-5">
        @extends('layout/notify')

        <h1>Solicitud de credito</h1>

        {{Form::open(array('url'=>'credito','method'=>'POST','files'=>true,'class'=>"Credito-form",'enctype'=>'multipar/form-data'))}}


        <section class="Credit-section u-CreditSection">

            <div class="material-input">
                {{ Form::select('document_type', $type,'',array('class'=>'Credit-select')) }}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('identification_card','',['id' => 'identification_card','required'])}}
                {{Form::label('identification_card','Cedula')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('name','',['id' => 'name','required'])}}
                {{Form::label('name','Nombre')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('second_name','',['id' => 'second_name','required'])}}
                {{Form::label('second_name','Segundo nombre')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('last_name','',['id' => 'last_name','required'])}}
                {{Form::label('last_name','Apellido')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('second_last_name','',['id' => 'second_last_name','required'])}}
                {{Form::label('second_last_name','Segundo apellido')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('birth_city','',['id' => 'birth_city','required'])}}
                {{Form::label('birt_city','Ciudad de nacimiento')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('residency_city','',['id' => 'residency_city','required'])}}
                {{Form::label('residency_city','Ciudad de residencia')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('date_expedition','',['id' => 'date_expedition','required'])}}
                {{Form::label('date_expedition','Fecha de expedicion')}}
                <span></span>
            </div>



        </section>

        <section class="Credit-section">

            <div class="material-input">
                {{Form::text('instead_expedition','',['id' => 'instead_expedition','required'])}}
                {{Form::label('instead_texpedition','Lugar de expedicion')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('date_birth','',['id' => 'date_birth','required'])}}
                {{Form::label('date_birt','Fecha de nacimiento')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('mobile_phone','',['id' => 'mobile_phone','required'])}}
                {{Form::label('mobile_phone','Numero del celular')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('phone','',['id' => 'phone','required'])}}
                {{Form::label('phone','Numero telefonico')}}
                <span></span>
            </div>


            <div class="material-input">
                {{Form::text('address','',['id' => 'address','required'])}}
                {{Form::label('address','Direccion')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('office_address','',['id' => 'office_address','required'])}}
                {{Form::label('office_address','Direcion de la oficina')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('monthly_income','',['id' => 'monthly_income','required'])}}
                {{Form::label('monthly_income','Ingresos mensuales')}}
                <span></span>
            </div>

            <div class="material-input">
                {{Form::text('monthly_expenses','',['id' => 'monthly_expenses','required'])}}
                {{Form::label('monthly_expenses','Egresos mensuales')}}
                <span></span>
            </div>

        </section>

        <p>Referencia Personal 1</p>

        <div class="material-input">
            {{Form::text('name_reference','',['id' => 'name_reference','required'])}}
            {{Form::label('Name_reference','Nombre')}}
            <span></span>
        </div>

        <div class="material-input">
            {{Form::text('phone_reference','',['id' => 'phone_reference','required'])}}
            {{Form::label('phone_reference','Telefono')}}
            <span></span>
        </div>

        <p>Referencia Personal2</p>

        <div class="material-input">
            {{Form::text('name_reference2','',['id' => 'name_reference2','required'])}}
            {{Form::label('Name_reference2','Nombre')}}
            <span></span>
        </div>

        <div class="material-input">
            {{Form::text('phone_reference2','',['id' => 'phone_reference2','required'])}}
            {{Form::label('phone_reference2','Telefono')}}
            <span></span>
        </div>
        <div id="hidden">
            {{Form::text('files','',['id'=>'form-files'])}}
            {{Form::label('files','Telefono')}}
        </div>
        <div class="pop-up ">
            <p>Sube <tus></tus> documentos</p>
            {{ HTML::image('img/image-file.svg','', array ('id' => 'image-file')) }}
            {{Form::file('file[]',array('id'=>'files','name'=>'file[]','multiple'))}}
        </div>

        <div class="request-image"> </div>


        <label class="label--checkbox">
            {{Form::checkbox('remember', 1, null, ['class' => 'checkbox'])}}
            Acepto las condiciones de lilipink
        </label>

        <button class="u-button">
            Enviar Solicitud
        </button>

        {{Form::close()}}
    </section>

@stop

@section('javascript')
    {{ HTML::script('js/credit.js'); }}
@stop