


var countImage = 0;
var name="";
var aux1=1,aux2=2,aux3=3,aux4=4;
$(function () {
    var $files = $('#files');
    $files.on('change', function () {
        for (var i = 0; i < this.files.length; i++) {
            if(i<4)
            {
                if (this.files[i].size < 2400000 ) {
                    if (countImage > 3){alert('Solo puedes subir hasta 4 archivos') ; return}
                    uploadImage(this.files[i]);

                } else {
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
                    saveImage(file);
                    countImage++;
                    break;
                case "image/jpeg":
                    var img = "<img src='img/jpg.png' />";
                    saveImage(file);
                    countImage++;
                    break;
                case "application/pdf":
                    var img = "<img src='img/pdf.png' />";
                    saveImage(file);
                    countImage++;
                    break;
                case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
                    var img = "<img src='img/doc.png' />";
                    saveImage(file);
                    countImage++;
                    break;
                default:
                    alert("el archivo no es soportado");
                    throw new Error('Invalid action.');
                    break;

            }
            classHtml='img-content'+countImage+'';
            document.getElementById("form-files").value=name;
            $('.request-image').append("<div class='img-content' id='hidden"+countImage+"' onclick='removeImage"+countImage+"();'>" + img + nombre + "</div>");
        };

}
function saveImage(file) {
    var form = document.querySelector('form');
    var request= new XMLHttpRequest();

        //e.preventDefault();
        //multiple files will be in the form parameter
        var formdata= new FormData(form);
        formdata.append('file',file)
        request.open('post','submit');//route
        request.send(formdata);

        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var myArr = JSON.parse(request.responseText);
                myFunction(myArr);
            }
        }




}

function myFunction(arr) {

    name=name+arr+",";
    document.getElementById("form-files").value=name;
}




console.log(name);
function removeImage1()
{
    document.getElementById("hidden"+aux1+"").classList.add("hidden");
    nombre=name.split(",");
    if(nombre.length==2)
    {
        var aux=aux1;
        aux1=aux4;
        aux2=aux;
        aux3=aux2;
        aux4=aux3;
        name="";
    }
    if(nombre.length==3)
    {
        var aux=aux1;
        aux1=aux4;
        aux2=aux;
        aux3=aux2;
        aux4=aux3;
        name=nombre[1]+",";
    }
    if(nombre.length==4)
    {
        var aux=aux1;
        aux1=aux4;
        aux2=aux;
        aux3=aux2;
        aux4=aux3;
        name=nombre[1]+","+nombre[2]+",";
    }
    if(nombre.length==5)
    {
        var aux=aux1;
        aux1=aux4;
        aux2=aux;
        aux3=aux2;
        aux4=aux3;
        name=nombre[1]+","+nombre[2]+","+nombre[3]+",";
    }
    console.log(aux1);
    document.getElementById("form-files").value=name;

    console.log(name);
    countImage--;
}
function removeImage2()
{
    document.getElementById("hidden"+aux2+"").classList.add("hidden");
    nombre=name.split(",");
    console.log(nombre.length);
    if(nombre.length==2)
    {
        var aux=aux1;
        aux1=aux4;
        aux2=aux;
        aux3=aux2;
        aux4=aux3;
        name="";
    }
    if(nombre.length==3)
    {
        var aux=aux2;
        aux2=aux3;
        aux3=aux4;
        aux4=aux1;
        aux1=aux;
        name=nombre[0]+",";
    }
    if(nombre.length==4)
    {
        var aux=aux2;
        aux2=aux3;
        aux3=aux4;
        aux4=aux1;
        aux1=aux;
        name=nombre[0]+","+nombre[2]+",";
    }
    if(nombre.length==5)
    {
        var aux=aux2;
        aux2=aux3;
        aux3=aux4;
        aux4=aux1;
        aux1=aux;
        name=nombre[0]+","+nombre[2]+","+nombre[3]+",";
    }
    document.getElementById("form-files").value=name;
    console.log(name);
    countImage--;
}
function removeImage3()
{
    document.getElementById("hidden"+aux3+"").classList.add("hidden");
    if(nombre.length==2)
    {
        var aux=aux1;
        aux1=aux4;
        aux2=aux;
        aux3=aux2;
        aux4=aux3;
        name="";
    }
    if(nombre.length==3)
    {
        var aux=aux2;
        aux2=aux3;
        aux3=aux4;
        aux4=aux1;
        aux1=aux;
        name=nombre[0]+",";
    }
    if(nombre.length==4)
    {
        var aux=aux3;
        aux3=aux4;
        aux4=aux1;
        aux1=aux2;
        aux2=aux;
        name=nombre[0]+","+nombre[1]+",";
    }
    if(nombre.length==5)
    {
        var aux=aux3;
        aux3=aux4;
        aux4=aux1;
        aux1=aux2;
        aux2=aux;
        name=nombre[0]+","+nombre[1]+","+nombre[3]+",";
    }
    document.getElementById("form-files").value=name;
    console.log(name);
    countImage--;
}
function removeImage4()
{
    document.getElementById("hidden"+aux4+"").classList.add("hidden");
    nombre=name.split(",");
    if(nombre.length==2)
    {
        var aux=aux1;
        aux1=aux4;
        aux2=aux;
        aux3=aux2;
        aux4=aux3;
        name="";
        name="";
    }
    if(nombre.length==3)
    {
        var aux=aux2;
        aux2=aux3;
        aux3=aux4;
        aux4=aux1;
        aux1=aux;
        name=nombre[0]+",";
    }
    if(nombre.length==4)
    {
        var aux=aux3;
        aux3=aux4;
        aux4=aux1;
        aux1=aux2;
        aux2=aux;
        name=nombre[0]+","+nombre[1]+",";
    }
    if(nombre.length==5)
    {

        name=nombre[0]+","+nombre[1]+","+nombre[3]+",";
    }
    document.getElementById("form-files").value=name;
    console.log(name);
    countImage--;
}


