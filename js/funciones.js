
function actualizarTablaCampañas() {
    $.ajax({
        url: './app/actualizarTablaCampanias.php',
        type: 'POST',
        success: function (data) {

            var datos = JSON.parse(data);
            // Selecciona la tabla por su id
            var tabla = $("#example2 tbody");

            tabla.empty();

            // Agrega los nuevos datos a la tabla
            $.each(datos, function (i, item) {
                var fila = $('<tr>');
                // fila.append($('<td>').text(item.CAMPAÑAID));
                fila.append($('<td>').text(item.NOMBRE));
                if (item.ESTADOCAMPAÑA == 'I') {
                    fila.append($('<td>').text('Inactiva'));
                } else if (item.ESTADOCAMPAÑA == 'A') {
                    if (item.ESTADO == 'I') {
                        fila.append($('<td>').text('Pendiente'));
                    } else if (item.ESTADO == 'A' || item.ESTADO == 'E') {
                        fila.append($('<td>').text('Enviando'));
                    } else if ((item.ESTADO == 'X')) {
                        fila.append($('<td>').text('Enviados'));
                    }
                }

                var tdaccion = $('<td>');
                tdaccion.append('<a style="margin-right: 4px;" class="w btn btn-info" href="./correosCampañas.php?id=' + item.NGEID + '">Detalles</a>');
                tdaccion.append('<a style="margin-right: 4px;" class="w btn btn-success" href="./editarCampaña.php?id=' + item.NGEID + '">Editar</a>');

                if (item.ESTADOCAMPAÑA == 'A') {
                    tdaccion.append('<a class="w btn btn-danger" onclick="eliminarCampaña(this)" data-id="' + item.NGEID + '" name="eliminarCampaña" id="eliminarCampaña" type="submit">Inactivar</a>');
                }

                fila.append(tdaccion);
                $('#example2 tbody').append(fila);
            });

        }
    });
};

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



// let table = new DataTable('#example2');
$(document).ready(function () {
    //links activos
    // Obtener el nombre del archivo actual sin la barra inicial y decodificar los caracteres UTF-8
    var currentPage = decodeURIComponent(location.pathname.split('/').pop().replace(/^\//, ''));

    // Obtener todos los enlaces en la barra de navegación
    var navLinks = document.querySelectorAll('nav a');

    // Iterar sobre los enlaces y agregar la clase "active" al enlace correspondiente
    for (var i = 0; i < navLinks.length; i++) {
        if (navLinks[i].getAttribute('href').indexOf(currentPage) !== -1) {
            navLinks[i].classList.add('active');
        }
    }

    //loguearse
    $('#enviar').click(async function (e) {
        e.preventDefault();

        const datosForm = new FormData(formLogin);

        //fetch nos devuelve promesas
        await fetch('app/funcionesLogin.php', {//envio la peticion
            method: "POST",
            body: datosForm
        })
            .then(resp => resp.text())//recibo la respuesta como texto o .json
            .then(data => {
                var datos = JSON.parse(data);
                estatus = datos[0];
                // console.log(datos[2].NOMBRE);
                if (estatus == 1) {
                    Swal.fire({
                        position: 'top-end',
                        // icon: 'success',
                        title: 'Bienvenido ' + datos[2].NOMBRE,
                        showConfirmButton: false,
                        timer: 1500,
                        customClass: {
                            popup: 'swal2-tiny'
                        }
                    })
                    setTimeout(() => {
                        window.location.href = "correos.php";
                    }, 1500);
                } else {
                    document.querySelector(".mensaje").innerHTML = datos[1];
                    // alert(data);
                }
            })
    });


    $('#validarDatosActualizar').click(function (e) {
        e.preventDefault();
        var nameId = "#validarDatosActualizar";
        var btn1 = "#actualizar";
        var btn2 = "#btnCancelar";
        validarDatos(nameId, btn1, btn2);
    });

    $('#validarDatosRegistrarse').click(function (e) {
        e.preventDefault();
        var nameId = "#validarDatosRegistrarse";
        var btn1 = "#registrarse";
        var btn2 = "#tengoUnaCuenta";
        validarDatos(nameId, btn1, btn2);
    });

    $('#registrarse').click(function (e) {
        e.preventDefault();
        const datosForm = new FormData(formRegistrarse);

        //fetch nos devuelve promesas
        fetch('app/funcionRegistrarse.php', {//envio la peticion
            method: "POST",
            body: datosForm
        })
            .then(resp => resp.text())//recibo la respuesta como texto o .json
            .then(data => {
                //

                var datos = JSON.parse(data);
                estatus = datos[0];
                // console.log(datos[2].NOMBRE);
                if (estatus == 1) {
                    // swal('Usuario creado correctamente!', '', 'success');
                    swal(datos[1], '', 'success');
                    setTimeout(function () {
                        window.location.href = "./index.php";
                    }, 3000);
                } else {
                    swal(datos[1], '', 'info');
                }
            })
    });

    $('#recuperarClave').click(function (e) {
        e.preventDefault();
        const datosForm = new FormData(formRecuperarClave);

        //inabilito los botones y input
        var input = $('#mail');
        // var boton = $('#cancelar');
        var boton1 = $('#recuperarClave');

        input.attr('readonly', true);
        // boton.attr('disabled', true);
        boton1.attr('disabled', true);

        $('#cancelar').css({
            'pointer-events': 'none',
            'opacity': '0.5'
        });

        document.querySelector(".mensaje").innerHTML = "";

        fetch('app/funcionRecuperarClave.php', {//envio la peticion
            method: "POST",
            body: datosForm
        })
            .then(resp => resp.text())//recibo la respuesta como texto o .json
            .then(data => {
                //
                if (data == 1) {
                    swal('Se envió un correo electrónico para restablecer su contraseña!', '', 'success');
                    document.querySelector(".mensaje").innerHTML = "";
                    setTimeout(function () {
                        window.location.href = "index.php";
                    }, 3000);
                } else {
                    document.querySelector(".mensaje").innerHTML = data;

                    input.attr('readonly', false);
                    boton1.attr('disabled', false);
                    $('#cancelar').css({
                        'pointer-events': '',
                        'opacity': '1'
                    });
                }
            })
    });

    $('#actualizarClave').click(function (e) {
        e.preventDefault();
        const datosForm = new FormData(formRestaurarClave);

        //fetch nos devuelve promesas
        fetch('app/funcionActualizarClave.php', {//envio la peticion
            method: "POST",
            body: datosForm
        })
            .then(resp => resp.text())//recibo la respuesta como texto o .json
            .then(data => {
                //
                if (data == 1) {
                    swal('Se actualizo su contraseña correctamente!', '', 'success');
                    setTimeout(function () {
                        window.location.href = "index.php";
                    }, 3000);
                } else {
                    document.querySelector(".mensaje").innerHTML = data;
                }
            })
    });


    $('#logout').click(function (e) {
        fetch('app/logout.php', {//envio la peticion
            method: "POST"
        })
            .then(resp => resp.text())//recibo la respuesta como texto o .json
            .then(data => {
                //
                if (data == 1) {
                    window.location.href = "index.php";
                } else {
                    swal(data, '', 'info');
                }
            })
    });

    //actualizar datos del perfil
    $('#actualizar').click(function (e) {
        e.preventDefault();
        const datosForm = new FormData(formRegistrarse);

        fetch('app/funcionActualizar.php', {//envio la peticion
            method: "POST",
            body: datosForm
        })
            .then(resp => resp.text())//recibo la respuesta como texto o .json
            .then(data => {
                //
                if (data == 1) {
                    swal('Usuario modificado correctamente!', '', 'success');
                    setTimeout(function () {
                        window.location.href = "correos.php";
                    }, 3000);
                } else {
                    swal(data, '', 'info');
                }
            })
    });

    $('#actualizarCampaña').click(function (e) {
        e.preventDefault();
        const datosForm = new FormData(formEditarCampaña);

        fetch('app/funcionActualizarCampaña.php', {//envio la peticion
            method: "POST",
            body: datosForm
        })
            .then(resp => resp.text())//recibo la respuesta como texto o .json
            .then(data => {
                //
                if (data == 1) {
                    swal('Campaña modificada correctamente!', '', 'success');
                    document.getElementById("mensajeCampaña").style.display = 'none';
                } else {
                    // swal(data, '', 'info');
                    document.getElementById("mensajeCampaña").style.display = 'block';
                    document.querySelector(".mensajeCampaña").innerHTML = data;
                }
            })
    });

});

