@extends('layout/front')
@section('title') Solicitud de Credito @stop
@section('content')
    {{ Session::get('mensaje') }}

    @if($errors->first())
            @if($errors->first('files'))
                <p>Ingrese los archivos requeridos</p>
            @endif
    @endif

    <section class="Credit u-shadow-5">
        @extends('layout/notify')

        <h1>Subir Excel</h1>

        <form action="{{route('excel')}}" method="POST" accept-charset="UTF-8" class="Credito-form" enctype="multipart/form-data">
            <input id="token" name="_token" type="hidden" value="{{csrf_token()}}">
            <input id="url" type="hidden" value="{{route('uploadTempFiles')}}">
            <input id="form-files" name="files" type="hidden" value="">

            <div class="pop-up">
                <p><b>Suba Varios Excel</b><br><span style="margin-top: 1.2rem; font-size: .83rem; display: block;">Los extractos deben ser divididos en varios archivos de 1MB o menos.</span></p>
                <input id="files" type="file" multiple >
            </div>

            <div id="request-xsl"></div>
            <button class="u-button"> Enviar Solicitud </button>
        </form>
    </section>
    <section id="preload" class="hidden">
        <div class="loader">Cargando...</div>
    </section>
@stop

@section('javascript')
    <script>

        function loadFiles(fileInput, maxSize){
            var files = fileInput.files,
                error = null,
                fd = new FormData();

            $.each(files, function(index, file){
                if(file.type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' || file.type == 'application/vnd.ms-excel'){
                    if(file.size < maxSize){
                        fd.append("file" + index, file);
                    } else {
                        error = {'error' : 'El archivo "' + file.name + '" es demasiado grande. El tamaño debe ser menor a 1MB'};
                    }
                } else {
                    error = {'error' : 'Tipo de archivo no permitido : ' + file.name + '.'};
                }
            });

            return error ? error : fd;
        }

        $('#files').on('change', function(){
            var inputFile = document.getElementById('files'),
                token = document.getElementById('token'),
                maxSize = 1000000,
                url = $('#url').val(),
                formData = loadFiles(inputFile, maxSize);

            if(formData.error){
                alert(formData.error);
                return false;
            }

            formData.append("_token", token);
            $.ajax({
                url: url,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                beforeSend: function() {
                    $('#preload').removeClass("hidden");
                },
                success: function (files) {
                    var html = '';

                    $.each(files, function(index, name){
                        html += '<div class="imageFile">' +
                                    '<span class="close">x</span>' +
                                    '<input type="hidden" name="file' + index + '" value="' + name + '">' +
                                    '<img src="/img/xls.png"/>' +
                                    '<span>' + name + '</span>' +
                                '</div>';
                    });

                    $('#request-xsl').append(html);
                    $('#preload').addClass("hidden");
                    $('.imageFile .close').on('click', function(){
                        $(this).parent().remove();
                    });
                },
                error: function () {
                    alert('No se ha podido subir este archivo. Intenta nuevamente');
                    $('#preload').addClass("hidden");
                }
            });
        });
    </script>
@stop
