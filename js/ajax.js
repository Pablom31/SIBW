

/*$(document).ready(function () {
    $('#search').onkeypress = hacerPeticionAjax();
});
*/

function hacerPeticionAjax() {
    palabra = $("#search").val();
    if (palabra != "") {
        $.ajax({
            data: { palabra },
            url: 'ajaxListaEventos.php',
            type: 'get',
            beforeSend: function () {
                $("#tablaResultados").html(null);
                $("#mensaje").show();
            },

            error: function (){
                alert("Error en la busqueda");
            },

            success: function (respuesta) {
                procesaRespuestaAjax(respuesta);
                $("#mensaje").hide();
            }
        });
    }else
        $("#tablaResultados").html(null);
}



function procesaRespuestaAjax(respuesta) {
    res = "";
    for (i = 0; i < respuesta.length; i++) {
        res += "<li ";

        if (!respuesta[i].publicado) {
            res += "class=eventoNegro ";
        }

        res += "id='respuesta'><a href='evento.php?ev=" + respuesta[i].id + "'>";

        if (!respuesta[i].publicado) {
            res += "<span id='noPubli' >Oculto</span>";
        }
        res += "<p>" + respuesta[i].nombre +"</p>"+ "</a></li>";
    }

    $("#resultados > ul").html(res);
}
/*
function procesaRespuestaAjax(respuesta) {
    res = "";
    for (i = 0; i < respuesta.length; i++) {
        res += "<tr><td ";
        if(!respuesta[i].publicado){
            res+="class=eventoNegro ";
        }
        res+="id='respuesta'><a href='evento.php?ev=" + respuesta[i].id + "'>";

        if (!respuesta[i].publicado) {
            res += "<span id='noPubli' ><p>Oculto</p></span>";
        }
        res+="<img id='fotoBusqueda' src='./imagenes/"+respuesta[i].imagen + "'>"+"<p>"+ respuesta[i].nombre +"</p>"+"</a></td></tr>";
    }

    $("#tablaResultados").html(res);
}*/

