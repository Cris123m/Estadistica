function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = "8-37-39-46";

    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
    }
}

function validaEspacios(id) {
    var text = document.getElementById(id).value;
    if (text != '') {
        var cadena = text.split('');
        var bandera = false;
        for (var i = 0; i < cadena.length; i++) {
            if (cadena[i] != ' ') {
                bandera = true;
            }
        }
        if (!bandera) {
            alert("No deje en blanco");
            document.getElementById(id).value = "";
            document.getElementById(id).focus();
        } 
    }
   
}

function validaComa(id) {
    var text = document.getElementById(id).value;
    if (text != '') {
        var cadena = text.split('');
        //var bandera = false;
        var contador = 0;
        for (var i = 0; i < cadena.length; i++) {
            if (cadena[i] == ',') {
                contador++;
            }
        }
        if (contador>1) {
            alert("Valor no permitido");
            document.getElementById(id).value = "";
            document.getElementById(id).focus();
        }
    }
}

function soloNumeros(e) {
    var key = window.Event ? e.which : e.keyCode
    return ((key >= 48 && key <= 57) || (key == 8) || (key == 44))
}

function Numeric(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 8) return true;
    patron = /[0-1]/
    te = String.fromCharCode(tecla);
    return patron.test(te);
}
function upper(ustr) {
    var str = ustr.value;
    ustr.value = str.toUpperCase();
}

function lower(ustr) {
    var str = ustr.value;
    ustr.value = str.toLowerCase();
}