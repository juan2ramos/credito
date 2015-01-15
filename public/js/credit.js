
$(function  () {
    $('#files').on('change',function(){

        for (var i = 0; i < this.files.length; i++) {
            uploadImage(this.files[i]);
            /*if ((/^image\/(gif|png|jpeg|pdf|docx|doc)$/i).test(this.files[i].type)) {
                if(this.files[i].size < 2400000){

                }else{
                    alert("El tamaño de la imagen debe ser inferior a 2MB");
                }

            } else {
                alert("tipo de archivo no soportado");
            }*/
        }
    });
    $('#files').on('dragover', function() {

        $('.pop-up').addClass('hover-file');
        $('#files').addClass('hover-file1');
    });
    $('#files').on('dragleave', function() {
        $('.pop-up').removeClass('hover-file');
        $('#files').removeClass('hover-file1');
    });
    $('#files').on('drop', function() {
        $('.pop-up').removeClass('hover-file');
        $('#files').removeClass('hover-file1');
    });
});

function uploadImage(file){
    var reader = new FileReader(file);

    reader.readAsDataURL(file);
    //ajax(file);
    reader.onload = function(e) {
        var data = e.target.result,
            $img = $('<img />').attr('src', data).fadeIn();
        var $name="</p>hola</p>";

        $('.imagen').append($img);
        $('.imagen').append($name);
    };
}
function ajax(file){

    var data = new FormData(),
        dataImage = '';
    data.append('file',file);
    $.ajax({
        url: 'uploadImage',
        type: 'POST',
        data: data,
        //necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
        //mientras enviamos el archivo
        beforeSend: function(){
            message = $("<span class='before'>Subiendo la imagen, por favor espere...</span>");
            $('#facebookG').addClass('show');
        },
        //una vez finalizado correctamente
        success: function(data){
            message = $("<span class='success'>La imagen ha subido correctamente.</span>");
            dataImage += $('#imagesUpload').val() + ';' + data;
            $('#facebookG').removeClass('show');
            $('#imagesUpload').val(dataImage);

        },
        //si ha ocurrido un error
        error: function(){
            message = $("<span class='error'>Ha ocurrido un error.</span>");
            console.log('test');
        }
    });
}