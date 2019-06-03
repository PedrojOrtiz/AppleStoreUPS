
var nombreUsuario = false
var apellidoUsuario = false
var contrasenia = false

function validarPass(label) {
    let span = document.getElementById(label)
    let pass1 = document.getElementById('pass').value
    let pass2 = document.getElementById('epass').value
    if (pass1 != pass2) {
        span.innerHTML = "Las contraseñas no coinciden"
        span.style.display = "block"
        contrasenia = false
    } else {
        span.style.display = "none"
        contrasenia = true
    }
}



function validarLetras(event, element) {
    //let span = document.getElementById(label)
    let letra = event.which || event.keyCode;
    //console.log(letra)
    if (letra >= 65 && letra <= 90 || letra == 32 || letra == 8 || letra == 16) {
        //span.style.display = "none"
        validarNombres(element)
    } else {
        //span.innerHTML = "Introdusca letras"
        //span.style.display = "block"
        let text = element.value
        text = text.substring(0, text.length - 1)
        element.value = text
    }
}

function validarNombres(element) {
    //let span = document.getElementById(label)
    let text = element.value
    if (text.split(" ").length > 2) {
        if (element.id == 'nombre') {
            //span.innerHTML = "Nombres incorrectos"
            nombreUsuario = false
        } else {
            //span.innerHTML = "Apellidos incorrectos"
            apellidoUsuario = false
        }
        //span.style.display = "block"
    } else {
        nombreUsuario = true
        apellidoUsuario = true
        //span.style.display = "none"
    }
}
function validarCamposObligatorios() {
    var bandera = false
    for (var i = 0; i < document.forms[0].length; i++) {
        var elemento = document.forms[0].elements[i]
        if (elemento.value.trim() == "") {
            bandera = true
            elemento.style.border = "1px solid red"
        }
    }

    //console.log("nombre: " + nombreUsuario)
    //console.log("apellido: " + apellidoUsuario)
    //console.log("pass: " + contrasenia)
    if (bandera) {
        alert("Llenar todos los campos")
        return false
    } else if (nombreUsuario == false || apellidoUsuario == false || contrasenia == false) {
        alert("Corriga los campos")
        return false
    }
    else {
        return true
    }
}

