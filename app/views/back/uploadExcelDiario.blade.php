@extends('layout/front')
@section('title') Solicitud de Credito @stop
@section('content')
    {{ Session::get('mensaje') }}
    {{ Session::get('mensaje_error') }}
    @if($errors->first())

        @if($errors->first('files'))
            <p>Ingrese los archivos requeridos</p>
        @endif

    @endif


    <section class="Credit u-shadow-5">
        @extends('layout/notify')

        <h1>Subir Excel Diario</h1>

        {{Form::open(array('route'=>'diario','method'=>'POST','files'=>true,'class'=>"Credito-form",'enctype'=>'multipar/form-data'))}}



        <div class="hidden">
            {{Form::text('files','',['id'=>'form-files'])}}
        </div>
        <div class="pop-up ">
            <p>Excel Diario</p>
            {{ HTML::image('img/image-file.svg','', array ('id' => 'image-file')) }}
            {{Form::file('file',array('id'=>'files','name'=>'file'))}}
        </div>
        <div id="request-xsl" > </div>

        <button class="u-button">
            Enviar Solicitud
        </button>

        {{Form::close()}}
    </section>
    <script>
        //subir imagenes para el sliders
        function archivo(evt) {
            var files = evt.target.files; // FileList object

            //Obtenemos la imagen del campo "file".
            for (var i = 0, f; f = files[i]; i++) {
                //Solo admitimos imágenes.


                var reader = new FileReader();

                reader.onload = (function(theFile) {
                    return function(e) {
                        // Creamos la imagen.
                        document.getElementById("request-xsl").innerHTML = ['<img src="img/xls.png" />'].join('');
                    };
                })(f);

                reader.readAsDataURL(f);
            }
        }

        document.getElementById('files').addEventListener('change', archivo, false);
    </script>

@stop

@section('javascript')
@stop
