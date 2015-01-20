
var countImage = 0;
var name="";
$(function () {
    var $files = $('#files');
    $files.on('change', function () {
        for (var i = 0; i < this.files.length; i++) {
            if (this.files[i].size < 2400000 ) {
                countImage++;
                if (countImage > 4){alert('Solo puedes subir hasta 4 archivos') ; return}
                uploadImage(this.files[i]);

            } else {
                alert("El tamaño de la imagen debe ser inferior a 2MB");
            }
        }
    });
    $files.on('dragover', function () {

        $('.pop-up').addClass('hover-file');
        $('#files').addClass('hover-file1');
        $('#image-file').addClass('hover-file2');
    });
    $files.on('dragleave', removeElement);
    $files.on('drop', removeElement);
});

function removeElement() {
    $('.pop-up').removeClass('hover-file');
    $('#files').removeClass('hover-file1');
    $('#image-file').removeClass('hover-file2');
}
function uploadImage(file) {
        var reader = new FileReader(file);

        reader.readAsDataURL(file);
        //ajax(file);
        reader.onload = function (e) {
            var data = e.target.result;
            var nombre = "<p class='p-image'>" + file.name + "</p>";
            switch (file.type) {

                case "image/png":
                    var img = "<img src='img/jpg.png' />";
                    name=name+file.name+",";
                    break;
                case "image/jpeg":
                    var img = "<img src='img/jpg.png' />";
                    name=name+file.name+",";
                    break;
                case "application/pdf":
                    var img = "<img src='img/pdf.png' />";
                    name=name+file.name+",";
                    break;
                case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
                    var img = "<img src='img/doc.png' />";
                    name=name+file.name+",";
                    break;
                case "application/msword":
                    var img = "<img src='img/doc.png' />";
                    name=name+file.name+",";
                    break;
                default:
                    alert("invalit");
                    throw new Error('Invalid action.');
                    break;

            }

            alert(name);
            $('.request-image').append("<div class='img-content'>" + img + nombre + "</div>");
        };

}
function ajax(file) {

    var data = new FormData(),
        dataImage = '';
    data.append('file', file);
    $.ajax({
        url: 'uploadImage',
        type: 'POST',
        data: data,
        //necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
        //mientras enviamos el archivo
        beforeSend: function () {
            message = $("<span class='before'>Subiendo la imagen, por favor espere...</span>");
            $('#facebookG').addClass('show');
        },
        //una vez finalizado correctamente
        success: function (data) {
            message = $("<span class='success'>La imagen ha subido correctamente.</span>");
            dataImage += $('#imagesUpload').val() + ';' + data;
            $('#facebookG').removeClass('show');
            $('#imagesUpload').val(dataImage);

        },
        //si ha ocurrido un error
        error: function () {
            message = $("<span class='error'>Ha ocurrido un error.</span>");
            console.log('test');
        }
    });
}