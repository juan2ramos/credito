


var countImage = 0,aux=0;
var name="";
$(function () {
    var $files = $('#files');
    $files.on('change', function () {
        for (var i = 0; i < this.files.length; i++) {
            if(i<4)
            {
                if (this.files[i].size < 2400000 ) {
                    if (countImage < 4){
                        aux=countImage+i;
                        if(aux<4)
                        {
                            uploadImage(this.files[i]);
                        }

                } else {
                    alert("solo se pueden subir 4 archivos");
                }
            }else{
                    alert("El tamaño de la imagen debe ser inferior a 2MB");
                }
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

        reader.onload = function (e) {
            var data = e.target.result;
            var nombre = "<p class='p-image'>" + file.name + "</p>";
            switch (file.type) {

                case "image/png":
                    var img = "<img src='img/jpg.png' />";
                    countImage++;
                    break;
                case "image/jpeg":
                    var img = "<img src='img/jpg.png' />";
                    countImage++;
                    break;
                case "application/pdf":
                    var img = "<img src='img/pdf.png' />";
                    countImage++;
                    break;
                case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
                    var img = "<img src='img/doc.png' />";
                    countImage++;
                    break;
                default:
                    alert("el archivo no es soportado");
                    throw new Error('Invalid action.');
                    break;

            }
            name=name+file.name+",";
            document.getElementById("form-files").value=name;
            $('.request-image').append("<div class='img-content' >" + img + nombre + "</div>");
        };

}
$('body').on('click','.img-content',function(){
    var nombre=$(this).find('p').text();
    $(this).remove();
    name=name.replace(nombre+",","");
    document.getElementById("form-files").value=name;
    countImage--;
});



