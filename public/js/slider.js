var i = 0;
$(document).on("ready", main);

function main(){
    var control = setInterval(cambiarSlider, 6000);
}

function cambiarSlider(){
    i++;
    if(i == $("#slider img").size()){
        i = 0;
    }
    procesos();
}

$(".slider").click(function(){

    i=$(this).text();
    procesos();
});

$("#back").click(function(){
    i--;
    if(i < 0){
        i = $("#slider img").size()-1;
    }

    procesos();
});
$("#next").click(function(){
    i++;

    if(i == $("#slider img").size()){
        i = 0;
    }
    procesos();
});

function procesos()
{
    $(".slider").removeClass('sliderValid');
    $(".slider").eq(i).addClass('sliderValid');
    $("#slider img").hide();
    $("#slider img").eq(i).fadeIn("medium");
}


//subir imagenes para el sliders
function archivo(evt) {
    var files = evt.target.files; // FileList object

    //Obtenemos la imagen del campo "file".
    for (var i = 0, f; f = files[i]; i++) {
        //Solo admitimos imágenes.

        if (!f.type.match('image.*')) {
            continue;
        }

        var reader = new FileReader();

        reader.onload = (function(theFile) {
            return function(e) {
                // Creamos la imagen.
                document.getElementById("request-image").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
            };
        })(f);

        reader.readAsDataURL(f);
    }
}

document.getElementById('files').addEventListener('change', archivo, false);

//boton nuevo y editar



function nuevo()
{
    var nuevo =document.getElementById('slider-new');
    nuevo.classList.remove('hidden');
    nuevo.classList.add('up');
}
function editar()
{
    var nuevo =document.getElementById('slider-new');
    nuevo.classList.add('hidden');
    nuevo.classList.remove('up');
}

//orden slider
var countSlider=[];
$('.number_slider').on('click',function()
{
    countSlider=[];
    $('.number_slider').each(function(index)
    {
        countSlider=countSlider+[$(this).val()];
    });
});


$('.number_slider').on('change', function ()
{

    var validator=0;
    for(var i=0;i<countSlider.length;i++)
    {
        if($(this).val()>0)
        {
            if(countSlider[i]==$(this).val())
            {
                validator=1;
            }
        }
    }
    if(validator==0)
    {
        countSlider=countSlider+[$(this).val()];
    }else{
        alert("ese numero ya asignado a otra imagen")
        $(this).val(0);
    }

});









