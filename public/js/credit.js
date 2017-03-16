var countImage = 0, aux = 0;
var name = "";
$(function () {

    $('#location').on('change', function () {
        var $point = $("#point ");
        console.log($(this).val())

        $point.children('option').hide();
        $point.children("option[data-city^='0']").show().prop('selected', true);
        //$point.children("option[data-city^=" + $(this).val() + "]").show();
        $point.children( "option[data-city=" + $(this).val() + "]" ).show()


    }).change();


    var $files = $('#files');
    $files.on('change', function () {
        for (var i = 0; i < this.files.length; i++) {
            if (i < 4) {
                if (this.files[i].size < 2400000) {
                    if (countImage < 4) {
                        aux = countImage + i;
                        if (aux < 4) {
                            $('.preload').removeClass("hidden");
                            uploadImage(this.files[i]);
                        }

                    } else {
                        alert("solo se pueden subir 4 archivos");
                    }
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
        switch (file.type) {

            case "image/png":
                var img = "<img src='img/jpg.png' />";
                countImage++;
                saveImage(file, img);
                break;
            case "image/jpeg":
                var img = "<img src='img/jpg.png' />";
                countImage++;
                saveImage(file, img);
                break;
            case "application/pdf":
                var img = "<img src='img/pdf.png' />";
                countImage++;
                saveImage(file, img);
                break;
            case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
                var img = "<img src='img/doc.png' />";
                countImage++;
                saveImage(file, img);
                break;
            default:
                alert("el archivo no es soportado");
                throw new Error('Invalid action.');
                break;

        }
    };

}
$('body').on('click', '.img-content', function () {
    var nombre = $(this).find('.p-image').text();
    $(this).remove();
    name = name.replace(nombre + ",", "");
    document.getElementById("form-files").value = name;
    countImage--;
});

function saveImage(file, img) {
    var form = document.querySelector('form');
    var request = new XMLHttpRequest();
    var x;
    //e.preventDefault();
    //multiple files will be in the form parameter
    var formdata = new FormData(form);
    formdata.append('file', file)
    request.open('post', 'submit');//route
    request.send(formdata);
    x = request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var myArr = JSON.parse(request.responseText);
            myFunction(myArr, img, file);
        }
    }

}

function myFunction(arr, img, file) {
    $(function () {

        name = name + arr + ",";
        document.getElementById("form-files").value = name;
        var nombre = "<p class='p-image'>" + arr + "</p>";
        var nombreOculto = "<p class='p-image1'>" + file.name + "</p>";
        $('.preload').addClass('hidden');
        $('.request-image').append("<div class='img-content' ><span class='close-button'><span class='close-line'></span><span class='close-line1'></span></span>" + img + nombreOculto + nombre + "</div>");
    });
}

$('.material-input').on('change', function () {
    var inputValue = $(this).find('input').val();
    var mobilePhone = $('#mobile_phone');
    var phone = $('#phone');
    if (inputValue) {
        $(this).find("span").css({"width": "100% "});
        $(this).find("label").css({"top": "-10px"});
        $(this).find("input").css({"height": "40px", "padding-top": " 20px"});
    } else {
        $(this).find("span").css({"width": "0%"});
        $(this).find("label").css({"top": "0px"});
        $(this).find("input").css({"height": "20px", "padding-top": " 10px"});
    }

    if (mobilePhone.val()) {
        phone.removeAttr("required", "required");
    } else {
        phone.attr("required", "required");
    }
    if (phone.val()) {
        mobilePhone.removeAttr("required", "required");
    } else {
        mobilePhone.attr("required", "required");
    }


});
$(function () {
    $(".material-input").each(function () {
        var $el = $(this);
        if ($el.find("input").val()) {
            $el.find("span").css({"width": "100% "});
            $el.find("label").css({"top": "-10px"});
            $el.find("input").css({"height": "40px", "padding-top": " 20px", "color": "#949494"});
        }
    });

});
$("#date_birth").on('change', function () {
    var $el = $(this);
    if ($('#date_birth').val()) {
        $el.css({"color": "#949494"});
    } else {
        $el.css({"color": "rgba(161, 161, 161, 0)"});
    }


});

$("#date_expedition").on('change', function () {
    var $el = $(this);
    if ($('#date_expedition').val()) {
        $el.css({"color": "#949494"});
    } else {
        $el.css({"color": "rgba(161, 161, 161, 0)"});
    }


});












