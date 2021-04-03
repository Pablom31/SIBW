
const prohibidas = ["tonto", "guarro", "gandul", "cabron", "mierda", "caca", "culo", "pedo", "pis", "gilipollas"];
var mostrarComentarios=false;
function mostrar() {
    var formulario = document.getElementById("cerrar"); 
    
    if (formulario.style.display === "none") {
        formulario.style.display = "block";
    } else {
        formulario.style.display = "none";
    }
    return false;
}



function palabrasProhibidas(){
    bloque = document.getElementById("coment");

    inp=bloque.value;
    var palabras = inp.split(" "); //Separo el string en un array de string de palabras
    ultima = palabras.pop();//Saco la ultima palabra escrita
    console.log(ultima);
    if (prohibidas.indexOf(ultima)!=-1){
        var nueva=inp.replace(ultima,cadenaAsteriscos(ultima));
        console.log(inp);
        bloque.value = nueva;
    }


}
function cadenaAsteriscos(palabra){
    var asteriscos="";
    for (i = 0; i < palabra.length; i++) {
        asteriscos+="*";
    }
    return asteriscos;
}

function Enviar(){
    var nombre = document.getElementById("fname").value;
    var correo = document.getElementById("correo").value;
    var hoy = new Date();
    var fecha = hoy.getDate() + '-' + (hoy.getMonth() + 1) + '-' + hoy.getFullYear();
    var hora = hoy.getHours() + ':' + hoy.getMinutes();
    var fechaYHora = fecha + ' ' + hora;
    var comentario = document.getElementById("coment").value;

    if (camposRellenados(nombre,correo,comentario) && validarEmail(correo) ) { 
       var clonForm = document.getElementById("comen").cloneNode(true);
        clonForm.innerHTML = '<p id="+nombre-comen">'+ nombre+'</p>'+
        '<p id = "fecha-comen">'+fechaYHora+'</p >'+
            '<p id="Comentario-comen">'+comentario+'</p>';
        document.getElementById("tablon").appendChild(clonForm);
    }

    return false;

}

function camposRellenados(nombre,email,comentario){
    if(nombre!="" && email!="" && comentario!=""){
        return true;
    }else{
        alert("No has introducido uno de los campos");
        return false;
    }
}

function validarEmail(valor) {
    if (/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i.test(valor)) {
        return true;
    } else {
        return false;
    }
}