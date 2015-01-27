


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
            switch (file.type) {

                case "image/png":
                    var img = "<img src='img/jpg.png' />";
                    countImage++;
                    saveImage(file,img);
                    break;
                case "image/jpeg":
                    var img = "<img src='img/jpg.png' />";
                    countImage++;
                    saveImage(file,img);
                    break;
                case "application/pdf":
                    var img = "<img src='img/pdf.png' />";
                    countImage++;
                    saveImage(file,img);
                    break;
                case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
                    var img = "<img src='img/doc.png' />";
                    countImage++;
                    saveImage(file,img);
                    break;
                default:
                    alert("el archivo no es soportado");
                    throw new Error('Invalid action.');
                    break;

            }
        };

}
$('body').on('click','.img-content',function(){
    var nombre=$(this).find('p').text();
    $(this).remove();
    name=name.replace(nombre+",","");
    document.getElementById("form-files").value=name;
    countImage--;
});

function saveImage(file,img) {
    var form = document.querySelector('form');
    var request= new XMLHttpRequest();
    var x;
            //e.preventDefault();
            //multiple files will be in the form parameter
        var formdata= new FormData(form);
        formdata.append('file',file)
        request.open('post','submit');//route
        request.send(formdata);
        x=request.onreadystatechange = function() {
       if (request.readyState == 4 && request.status == 200) {
               var myArr = JSON.parse(request.responseText);
                myFunction(myArr,img);
                return x;
                }
            }
}

function myFunction(arr,img) {
    $(function(){
        name=name+arr+",";
        document.getElementById("form-files").value=name;
        var nombre = "<p class='p-image'>" + arr + "</p>";
        $('.request-image').append("<div class='img-content' ><span class='close-button'><span class='close-line'></span><span class='close-line1'></span></span>" +img+  nombre + "</div>");
    });
}
/*
$('.material-input').on('change',function(){
    var inputValue=$(this).find('input').val();
    if(inputValue)
    {
        //$(this).find("span").css({"width":"100%"});
        //$(this).find('input').css({"height":"40px !important","padding-top":"20px"});
    }else
    {
        //$(this).find("span").css({"width":"0%"});
      //  $(this).find('input').css({"height":"20px !important","padding-top":"0px"});
    }
});

$('.material-input').on('focus',function(){
    //$(this).find('input').css({"height":"40px !important"});
});
*/





