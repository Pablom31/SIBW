
var prohibidas = [];

var mostrarComentarios=false;

var bloque = document.getElementById("aniadirPalabras");

var inp = bloque.innerText;
var palabras = inp.split(' ');
for (i = 0; i < palabras.length; i++) {
    prohibidas.push(palabras[i].toUpperCase());
    console.log(palabras[i]);
}



function mostrar(palabras) {
    var formulario = document.getElementById("cerrar"); 
    
    if (formulario.style.display === "none") {
        formulario.style.display = "block";
    } else {
        formulario.style.display = "none";
    }
    return false;
}



function palabrasProhibidas(){
    var bloque = document.getElementById("coment");

    var inp=bloque.value;
    var palabras = inp.split(" "); //Separo el string en un array de string de palabras
    ultima = palabras.pop();//Saco la ultima palabra escrita
    if (prohibidas.indexOf(ultima.toUpperCase())!=-1){
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
       /*var clonForm = document.getElementById("comen").cloneNode(true);
        clonForm.innerHTML = '<p id="+nombre-comen">'+ nombre+'</p>'+
        '<p id = "fecha-comen">'+fechaYHora+'</p >'+
            '<p id="Comentario-comen">'+comentario+'</p>';
        document.getElementById("tablon").appendChild(clonForm);*/
        return true;
    }

    return false;

}

function camposRellenados(nombre,email,comentario){
    if (nombre != "" && email != "" && comentario != "") {
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
        alert("Correo erroneo")
        return false;
    }
}




function comprobarRegistro() {

    var nombre = document.getElementById("nick2").value;
    var correo = document.getElementById("email2").value;
    var contrasenia = document.getElementById("contrasenia2").value;
    if (camposRellenados(nombre, correo, contrasenia) && validarEmail(correo)) {
        return true;
    }
    return false;

}
