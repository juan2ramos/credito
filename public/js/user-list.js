$('#activeUser, #destroyUser, #disableUser').on('click', function(){
    var r = $(this).attr('id') == 'activeUser'
        ? '¿Estas seguro que deseas aprobar este usuario?'
        : '¿Deseas desaprobar este usuario?';

    if(confirm(r)){
        $.ajax({
            url : $(this).attr('route'),
            type : 'GET',
            success : function(data){
                console.log(data);
                //location.reload();
            }, error : function(e){
                alert('Hubo un error');
                console.log(e);
            }
        });
    }
});

$('.openPopup').on('click', function(){

    $.ajax({
        url : $(this).attr('route'),
        type : 'GET',
        data : {
            type    : $(this).attr('type'),
            enable  : $(this).attr('enable'),
            disable : $(this).attr('disable')
        },
        success : function(data){
            var user = data.user;
            var options = $('#options').children();
            options.eq(0).attr('route', data.routes.enable);
            options.eq(1).attr('route', data.routes.disable);
            var html = "";
            html += "<tr>" +
                "<th>Nombres</th>" +
                "<td>" + user.name + " " + user.second_name + " " + user.last_name + " " + user.second_last_name + "</td>" +
                "</tr>" +
                "<tr>" +
                "<th>Email</th>" +
                "<td>" + user.email + "</td>" +
                "</tr>" +
                "<tr>" +
                "<th>Cedula</th>" +
                "<td>" + user.identification_card + "</td>" +
                "</tr>" +
                "<tr>" +
                "<th>Celular</th>" +
                "<td>" + user.mobile_phone + "</td>" +
                "</tr>" +
                "<tr>" +
                "<th>Telefono</th>" +
                "<td>" + user.mobile_phone + "</td>" +
                "</tr>" +
                "<tr>" +
                "<th>Ciudad de residencia</th>" +
                "<td>" + user.residency_city + "</td>" +
                "</tr>" +
                "<tr>" +
                "<th>Dirección</th>" +
                "<td>" + user.address +"</td>" +
                "</tr>";
            $('#reload').html(html);
            $('#DataUser').show();
        },
        error: function(){alert('error');}
    });
    return false;
});