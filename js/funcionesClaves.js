function mostrarClaveEnvio() {
    var cuentaClave = document.getElementById("cuentaClave");
    if (cuentaClave.type == "password") {
        cuentaClave.type = "text";
    } else {
        cuentaClave.type = "password";
    }
};

function mostrarClaveLogin() {
    var clave = document.getElementById("password");
    if (clave.type == "password") {
        clave.type = "text";
    } else {
        clave.type = "password";
    }
};

function mostrarClaveLoginVerificacion() {
    var clave = document.getElementById("clave");
    var clave2 = document.getElementById("clave2");
    if (clave2.type == "password") {
        clave2.type = "text";
    } else {
        clave2.type = "password";
    }

    if (clave.type == "password") {
        clave.type = "text";
    } else {
        clave.type = "password";
    }
};

function mostrarClaveEnvio() {
    var cuentaClave = document.getElementById("cuentaClave");
    if (cuentaClave.type == "password") {
        cuentaClave.type = "text";
    } else {
        cuentaClave.type = "password";
    }
};

//solo ingresar los caracteres permitidos
function validarMascara(input) {
    var valor = input.value;
    var regex = /^[A-Za-z0-9.]*$/;
    var nuevoValor = "";
    for (var i = 0; i < valor.length; i++) {
        if (regex.test(valor[i])) {
            nuevoValor += valor[i];
        }
    }
    input.value = nuevoValor;
}


//mostrar si cumple las condiciones de la contraseña
if (document.getElementById('clave')) {
    const inputElement = document.getElementById('clave');
    const resultadoElement = document.getElementById('resultado');

    inputElement.addEventListener('input', (event) => {
        const texto = event.target.value; // Obtenemos el valor actual del campo de entrada
        let mensajes = '';

        // Validamos si el texto contiene letras mayúsculas, minúsculas o números
        if (/[A-Z]/.test(texto)) {
            mensajes += '<span class="verde">Mayúsculas <i class="fa fa-check" aria-hidden="true"></i></span><br>';
        } else {
            mensajes += '<span class="rojo">Mayúsculas <i class="fa fa-times" aria-hidden="true"></i></span><br>';
        }
        if (/[a-z]/.test(texto)) {
            mensajes += '<span class="verde">Minúsculas <i class="fa fa-check" aria-hidden="true"></i></span><br>';
        } else {
            mensajes += '<span class="rojo">Minúsculas <i class="fa fa-times" aria-hidden="true"></i></span><br>';
        }
        if (/[0-9]/.test(texto)) {
            mensajes += '<span class="verde">Números <i class="fa fa-check" aria-hidden="true"></i></span><br>';
        } else {
            mensajes += '<span class="rojo">Números <i class="fa fa-times" aria-hidden="true"></i></span><br>';
        }
        if (/\./.test(texto)) {
            mensajes += '<span class="verde">Signo de puntuacion/punto <i class="fa fa-check" aria-hidden="true"></i></span><br>';
        } else {
            mensajes += '<span class="rojo">Signo de puntuacion/punto <i class="fa fa-times" aria-hidden="true"></i></span><br>';
        }
        if (texto.length >= 8) {
            mensajes += '<span class="verde">8 caracteres <i class="fa fa-check" aria-hidden="true"></i></span><br>';
        } else {
            mensajes += '<span class="rojo">8 caracteres <i class="fa fa-times" aria-hidden="true"></i></span><br>';
        }

        // if(/[A-Z]/.test(texto) && /[a-z]/.test(texto) && /[0-9]/.test(texto) && /\./.test(texto) && texto.length >= 8){
        //     mensajes = "";
        // }

        resultadoElement.innerHTML = mensajes;
    });
}

//validar credenciales de envio de correos 
function validarDatos(nameId, btn1, btn2) {
    // const datosForm = new FormData(formRegistrarse);

    // document.querySelector('.load').classList.add('visible');
    document.getElementById('spin').style.display = 'inline-block'
    document.getElementById("correcto").style.display = 'none';
    document.getElementById("incorrecto").style.display = 'none';


    //inabilito los botones y input
    var inputMail = $('#cuentaCorreo');
    var input = $('#cuentaClave');
    var boton = $(nameId);
    var boton1 = $(btn1);

    inputMail.attr('readonly', true);
    input.attr('readonly', true);
    boton.attr('disabled', true);
    boton1.attr('disabled', true);

    $(btn2).css({
        'pointer-events': 'none',
        'opacity': '0.5'
    });


    const datosform = new FormData(formRegistrarse);

    $.ajax({
        type: 'POST',
        url: './app/validarCredenciales.php',
        data: datosform,
        processData: false,
        contentType: false,
        success: function (data) {


            if (data == 1) {
                swal('Las credenciales son validas!', '', 'success');
                document.getElementById("incorrecto").style.display = 'none';
                document.getElementById('spin').style.display = 'none'
                // document.querySelector('.load').classList.remove('visible');
                document.getElementById("correcto").style.display = 'inline';
                // var inputMail = $('#cuentaCorreo');
                inputMail.attr('readonly', true);
                // var input = $('#cuentaClave');
                input.attr('readonly', true);
                // var boton = $(nameId);
                boton.attr('disabled', true);

            } else {
                swal(data, '', 'info');
                inputMail.attr('readonly', false);
                input.attr('readonly', false);
                boton.attr('disabled', false);

                document.getElementById("correcto").style.display = 'none';
                document.getElementById("incorrecto").style.display = 'inline';
                // document.querySelector('.load').classList.remove('visible');
                document.getElementById('spin').style.display = 'none'
            }

            boton1.attr('disabled', false);
            $(btn2).css({
                'pointer-events': '',
                'opacity': '1'
            });
        }
    });
};


$(document).ready(function () {
    //contraseña segura
    $('#clave').keyup(function () {
        var boton = $('#actualizar');
        var btnRegistrarse = $('#registrarse');
        var password = $(this).val();
        if (document.getElementById("actualizarClave")) {
            var btnActualizar = $('#actualizarClave');
        }


        var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\.)[a-zA-Z\d.]{8,}$/;
        if (!regex.test(password)) {
            $(this).css('border-color', 'red');
            $('#error').text('La contraseña debe contener al menos una letra minúscula, una mayúscula, un número, un punto y como mínimo 8 caracteres.');
            boton.attr('disabled', true);
            btnRegistrarse.attr('disabled', true);
            //si esta en el formulario de actualizar contraseña
            // btnActualizar.attr('disabled', true);
            if (document.getElementById("actualizarClave")) {
                // var btnActualizar = $('#actualizarClave');
                btnActualizar.attr('disabled', true);
            }
        } else {
            $(this).css('border-color', 'green');
            $('#error').text('');
            boton.attr('disabled', false);
            btnRegistrarse.attr('disabled', false);
            if (document.getElementById("actualizarClave")) {
                // var btnActualizar = $('#actualizarClave');
                btnActualizar.attr('disabled', false);
            }
        }
    });
})