var i=0;
$(function  () {
    $('#files').on('change',function(){

        for (var i = 0; i < this.files.length; i++) {
            if(this.files[i].size<2400000){
                uploadImage(this.files[i]);
            }else{
                alert("El tamaño de la imagen debe ser inferior a 2MB");
            }

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
        $('#image-file').addClass('hover-file2');
    });
    $('#files').on('dragleave', function() {
        $('.pop-up').removeClass('hover-file');
        $('#files').removeClass('hover-file1');
        $('#image-file').removeClass('hover-file2');
    });
    $('#files').on('drop', function() {
        $('.pop-up').removeClass('hover-file');
        $('#files').removeClass('hover-file1');
        $('#image-file').removeClass('hover-file2');
    });
});

function uploadImage(file){
    i++;
    if(i<5)
    {
        var reader = new FileReader(file);

        reader.readAsDataURL(file);
        //ajax(file);
        reader.onload = function(e) {
            var data = e.target.result;
            //$img = $('<img />').attr('src', data).fadeIn();

            var nombre="<p class='p-image'>"+file.name+"</p>";

            switch(file.type) {

                case "image/png":
                    var img = "<img src='img/jpg.png' />";
                    break;
                case "image/jpeg":
                    var img = "<img src='img/jpg.png' />";
                    break;
                case "application/pdf":
                    var img = "<img src='img/pdf.png' />";
                    break;
                case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
                    var img = "<img src='img/doc.png' />";
                    break;
                case "application/msword":
                    var img = "<img src='img/doc.png' />";
                    break;
                default:
                    alert("invalit");
                    throw new Error('Invalid action.');
                    break;

            }

            $('.request-image').append("<div class='img-content'>"+img+nombre+"</div>");
        };
    }else{
        alert("solo se pueden subir 4 archivos");
    }

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