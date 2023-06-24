<?php
// borrar lo comentado al hacer pruebas en el servidor
include "./app/conexion.php";
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['activo'])) {
    header("Location:index.php");
}

$usuarioId = $_SESSION['campoId'];
$nombreUsuario = $_SESSION['campoNombre'];

//obtengo los datos de las campañas del usuario
$query = "SELECT NGE.NGEID AS CAMPAÑAID, NGE.USUARIOID AS USUARIOID, NGE.NOMBRES AS NOMBRE, 
C.ESTADO AS ESTADO,UC.NGEID AS NGEID, NGE.IMAGEN, SEC.ESTADO AS ESTADOSOLICITUD, C.ASUNTO AS ASUNTO, C.SALUDO AS SALUDO,
C.CUERPO AS CUERPO FROM NOMBRESGRUPOSEXCEL NGE
INNER JOIN USUARIOSCORREOS UC
ON NGE.NGEID = UC.NGEID
INNER JOIN CORREOS C
ON UC.CORREOID = C.CORREOID
INNER JOIN SOLICITUDENVIARCORREOS SEC
ON NGE.NGEID = SEC.NGEID 
WHERE NGE.USUARIOID = :id AND C.ESTADO = 'P' AND NGE.ESTADO = 'A'
GROUP BY NGE.NOMBRES, C.ESTADO;";
$stmt = $conexion->prepare($query);
$stmt->bindParam(":id", $usuarioId, PDO::PARAM_INT);
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
$stmt->closeCursor();

$primeraFila = $resultado[0];
$nombre = $primeraFila->NOMBRE;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emailsend</title>
    <link rel="icon" type="image/jpg" href="./css/favicon.ico" />
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <?php require "navegacion.php" ?>
    <div class="container-fluid">
        <div class="row justify-content-center pt-3">

        </div>
        <div class="row justify-content-center pt-3">
            <div class="col-md-10">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="text-center">Envió de Correos Electrónicos </h3>
                    </div>
                    <form id="guardarCampaña" enctype="multipart/form-data" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- <form id="guardarExcel" enctype="multipart/form-data" method="POST"> -->
                                <input type="hidden" id="idUsuario" value="<?php echo  $usuarioId ?>">
                                <div class="card-body mb-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nombreCampaña">Nombre campaña</label>
                                                <input type="text" class="form-control" name="nombreCampaña" id="nombreCampaña" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div>
                                                <label for="dataCliente">Archivo Excel</label>
                                            </div>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="dataCliente" id="dataCliente" class="custom-file-input" accept=".csv" required />
                                                    <label for="file-input" id="textoFile" class="custom-file-label">
                                                        No se ha seleccionado ningún archivo.
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mensaje pt-3" style="height: 20px;" id="mensaje">
                                            </div>
                                            <!-- mensaje de error -->
                                            <div id="contenedor"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pt-3">
                                <div class="col-md-12">
                                    <div>
                                        <label for="uploadedfile">Imagen para la plantilla de correos</label>
                                    </div>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="uploadedfile" id="uploadedfile" class="custom-file-input" accept="image/png,image/jpeg" />
                                            <label for="file-input" class="custom-file-label" id="textoImg">
                                                No se ha seleccionado ningún archivo.
                                            </label>
                                        </div>
                                    </div>
                                    <div class="pt-3">
                                        <img class="imgPrevisualizacion" id="imgPrevisualizacion">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-inline-block">
                                <input type="submit" onclick="clicked(event)" id="guardarGrupo" name="guardarGrupo" class="btn btn-primary btn-enviar" value="Guardar Campaña" />
                            </div>
                            <div class="icon d-inline-block">
                                <a href="formato/Subir.csv" class="btn btn-success" download="Formato.csv">
                                    Formato
                                    <i class="fa fa-download"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row justify-content-center pt-3">
            <div class="col-md-10">
                <div class="card card-info">
                    <form id="campañas" enctype="multipart/form-data">
                        <div class="card-header">
                            <h3 class="text-center">Campañas pendientes</h3>
                        </div>
                        <input type="hidden" id="idUsuario" value="<?php echo  $usuarioId ?>">
                        <div class="card-body mb-5">
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <div class="table-responsive">
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center" style="width: 15%">Imagen</th>
                                                    <th class="text-center">Vista Previa</th>
                                                    <th class="text-center" style="width: 55%">Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (isset($resultado)) { ?>
                                                    <?php foreach ($resultado as $fila) { ?>
                                                        <tr id="<?php echo $fila->NGEID; ?>">
                                                            <td value="<?php echo $fila->NOMBRE; ?>"> <?php echo $fila->NOMBRE; ?></td>
                                                            <td class="text-center">
                                                                <?php
                                                                $campaña = $fila->NOMBRE;
                                                                $carpeta = str_replace(' ', '', $campaña);
                                                                $rutaImg = "./imagenes/" . $usuarioId . "/" . $carpeta . "\imagen.png";
                                                                ?>
                                                                <img src="<?php echo $fila->IMAGEN; ?>" style="height: 40px;" alt="">
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-light" data-toggle="modal" data-target="#myModal<?php echo $fila->NGEID; ?>" title="Vista Previa">
                                                                    <i class="fa fa-eye"></i>
                                                                </button>
                                                            </td>
                                                            <td class="text-center">
                                                                <a class="wt btn btn-info" href="./correosCampañas.php?id=<?php echo $fila->NGEID; ?>">
                                                                    Ver estado
                                                                </a>
                                                                <?php
                                                                if ($fila->ESTADOSOLICITUD == 'A') {
                                                                    $soloLectura = "opacity: 0.5;pointer-events: none;";
                                                                } else {
                                                                    $soloLectura = "";
                                                                }
                                                                ?>
                                                                <a style="<?php echo $soloLectura; ?>" class="wt btn btn-success" href="./editarCampaña.php?id=<?php echo $fila->NGEID; ?>">
                                                                    Editar
                                                                </a>
                                                                <a style="<?php echo $soloLectura; ?>" class="wt btn btn-primary" onclick="enviar(this)" data-id="<?php echo $fila->NGEID; ?>" name="enviarCorreos" id="enviarCorreos" type="submit">
                                                                    Enviar Correos
                                                                </a>
                                                                <?php
                                                                if ($fila->ESTADOSOLICITUD == 'I') {
                                                                    $soloLectura = "opacity: 0.5;pointer-events: none;";
                                                                } else {
                                                                    $soloLectura = "";
                                                                }

                                                                ?>
                                                                <a style="<?php echo $soloLectura; ?>" class="cancelar wt btn btn-danger" onclick="cancelarEnvio(this)" data-id="<?php echo $fila->NGEID; ?>" name="cancelarEnvio" id="cancelarEnvio" type="submit">
                                                                    Cancelar
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <!-- ventana modal -->
                                                        <div class="modal fade" id="myModal<?php echo $fila->NGEID; ?>" tabindex="-1" role="dialog" aria-labelledby="myModal<?php echo $fila->NGEID; ?>Label" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myModal<?php echo $fila->NGEID; ?>Label" title="Asunto"><?php echo $fila->ASUNTO; ?></h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <body>
                                                                            <b title="Saludo"><?php echo $fila->SALUDO; ?></b>
                                                                            <br /><br />
                                                                            <p title="Cuerpo del correo"><?php echo nl2br($fila->CUERPO); ?></p>
                                                                            <br /><br /><br /><br /><img src='<?php echo $fila->IMAGEN; ?>' width='60%'>
                                                                        </body>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot></tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<div class="footer">
    <?php require("footer.php") ?>
</div>
<script src="./plugins/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script src="./js/funciones.js"></script>
<script src="./js/funcionesVisualizarImagen.js"></script>
<script>
    //cuando la pagina cargue, llamar funcion que valide sin se estan enviando correos
    window.onload = function() {
        validarEnvios();
        correosEnviados();
        // actualizarTabla();
        setInterval(() => {
            validarEnvios();
            correosEnviados();
            // actualizarTabla();
        }, 3000);
    };

    //nombre del archivo seleccionado
    const fileInput = document.getElementById('dataCliente');
    const fileName = document.getElementById('textoFile');

    fileInput.addEventListener('change', (event) => {
        const selectedFile = event.target.files[0];

        // Actualizar el contenido del párrafo con el nombre del archivo
        fileName.textContent = selectedFile ? selectedFile.name : "No se ha seleccionado ningún archivo.";
    });


    // funcion para confirmar si se estan enviando correos
    function validarEnvios() {
        $.ajax({
            url: './app/validarEnvioCorreos.php',
            type: 'POST',
            success: function(data) {
                marcarFila(data);
            }
        });
    };

    function correosEnviados() {
        $.ajax({
            url: './app/existenCorreos.php',
            type: 'POST',
            success: function(data) {
                if (data == 1) {
                    swal("Los correos han sido enviados", "", "success");
                    //Llamo la funcion para actualizar el estado y no mostrar de nuevo el mensaje
                    actualizarEstado();
                }
            }
        });
    };

    function actualizarEstado() {
        $.ajax({
            url: './app/actualizarEstado.php',
            type: 'POST',
            success: function(data) {
                if (data == 1) {
                    swal("Los correos han sido enviados", "", "success");
                    enviar();
                }
            }
        });
    };

    function actualizarTabla() {
        // alert("actualizar tabla")
        $.ajax({
            url: './app/actualizarTabla.php',
            type: 'POST',
            success: function(data) {
                // console.log((data));

                // Parsea los datos que vienen en formato JSON
                var datos = JSON.parse(data);
                // Selecciona la tabla por su id
                var tabla = $("#example2").DataTable();

                // Limpiar los datos existentes en la tabla
                tabla.clear();

                // Agregar los nuevos datos a la tabla
                $.each(datos, function(i, item) {
                    // Agregar una nueva fila con los datos
                    tabla.row.add([
                        item.NOMBRE,
                        '<img style="display: block; margin: 0 auto;" src="' + item.IMAGEN + '" height="40px">',
                        '<button style="display: block; margin: 0 auto;" type="button" class="btn btn-light" data-toggle="modal" data-target="#myModal' + item.NGEID + '"><i class="fa fa-eye"></i></button>',
                        '<a style="margin-right: 5px; margin-left: 8px;" class="wt btn btn-info" href="./correosCampañas.php?id=' + item.NGEID + '">Ver estado</a>' +
                        '<a style="margin-right: 4px; ' + (item.ESTADOSOLICITUD == 'A' ? 'opacity: 0.5;pointer-events: none;' : '') + '" class="wt btn btn-success" href="./editarCampaña.php?id=' + item.NGEID + '">Editar</a>' +
                        '<a style="margin-right: 4px; ' + (item.ESTADOSOLICITUD == 'A' ? 'opacity: 0.5;pointer-events: none;' : '') + '" class="wt btn btn-primary" onclick="enviar(this)" data-id="' + item.NGEID + '" name="enviarCorreos" id="enviarCorreos" type="submit">Enviar Correos</a>' +
                        '<a style="' + (item.ESTADOSOLICITUD == 'I' ? 'opacity: 0.5;pointer-events: none;' : '') + '" class="wt btn btn-danger" onclick="cancelarEnvio(this)" data-id="' + item.NGEID + '" name="cancelarEnvio" id="cancelarEnvio" type="submit">Cancelar</a>'
                    ]).draw(false);
                });

            }
        });
    };

    function enviar(boton) {
        var fila = boton.parentNode.parentNode;
        var id = boton.getAttribute('data-id');
        existenCorreos(id);
    };

    function existenCorreos(grupoId) {
        var grupoId = {
            "grupoId": grupoId
        };
        $.ajax({
            data: grupoId,
            url: './app/funcionesEnviarCorreo.php', //actualiza el estado de las solicitudes a activo para asi empesar a enviar los correos
            type: 'POST',
            success: function(data) {
                if (data == 1) {
                    // actualizarTabla();
                    // setTimeout(() => {
                    marcarFila(grupoId["grupoId"]);
                    // }, 500);
                    // setTimeout(() => {
                    enviarCorreos(grupoId["grupoId"]);
                    // }, 500);
                } else {
                    swal("Los correos han sido enviados!", "", "success");
                }
            }
        });
    };

    function enviarCorreos(grupoId) {
        var grupoId = {
            "grupoId": grupoId
        };
        $.ajax({
            data: grupoId,
            url: './app/enviarCorreos.php',
            type: 'POST',
            success: function(data) {
                actualizarTabla();
                swal(data, "", "info");
            }
        });

    };

    //funcion para indicar que campaña se esta enviando
    function marcarFila(campañaID) {
        // alert("marcar fila")

        // if (campañaID > 0) {
        //     var fila = document.getElementById(campañaID);
        //     // Obtener la tabla por su ID
        //     var tabla = document.getElementById("example2");

        //     // Obtener todas las filas de la tabla
        //     var filas = tabla.getElementsByTagName("tr");

        //     // Recorrer todas las filas y quitar el color de fondo
        //     for (var i = 0; i < filas.length; i++) {
        //         filas[i].style.backgroundColor = '';
        //     }

        //     if (fila !== null || fila !== undefined) {
        //         fila.style.backgroundColor = "rgb(191, 255, 162)";
        //     }

        // }
    };

    function cancelarEnvio(boton) {
        // Obtener la fila a la que pertenece el botón
        var fila = boton.parentNode.parentNode;
        // Obtener el identificador del elemento correspondiente en la base de datos
        var id = boton.getAttribute('data-id');
        var NGEID = {
            "NGEID": id
        };
        $.ajax({
            data: NGEID,
            url: './app/cancelarEnvioCorreos.php',
            type: 'POST',
            success: function(data) {
                swal(data, "", "success");
                var tabla = document.getElementById("example2");
                // Obtener todas las filas de la tabla
                var filas = tabla.getElementsByTagName("tr");
                // Recorrer todas las filas y quitar el color de fondo
                for (var i = 0; i < filas.length; i++) {
                    filas[i].style.backgroundColor = '';
                }
                actualizarTabla();
            }
        });
    }

    const btn = document.getElementById('guardarGrupo');

    function clicked(event) {
        event.preventDefault();

        const datosForm = new FormData(guardarCampaña);

        fetch('./app/guardarExcel.php', { //envio la peticion
                method: "POST",
                body: datosForm
            })
            .then(resp => resp.text()) //recibo la respuesta como texto o .json
            .then(data => {
                if (data > 1) {
                    swal("Campaña creada correctamente!", "", "success");
                    document.getElementById("mensaje").style.display = 'none';
                    input = document.getElementById("dataCliente");
                    nombre = document.getElementById("nombreCampaña");
                    input.value = ''
                    nombre.value = '';
                    setTimeout(() => {
                        window.location.href = "./correos.php";
                    }, 2000);
                } else {
                    document.getElementById("mensaje").style.display = 'block';
                    document.querySelector(".mensaje").innerHTML = data;
                }
            })
    }

    $(document).ready(function() {
        $('#example2').DataTable({
            "pageLength": 5,
            "lengthMenu": [5, 10, 20, 50, 100],
            "paging": true, // Habilitar paginación
            "destroy": true, // Destruir la tabla existente antes de crear una nueva
            "language": { // Configurar el idioma de la paginación
                "search": "Buscar", // Traducción de "search"
                "lengthMenu": "Mostrar _MENU_ entradas por página", // Traducción de "entries"
                "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas", // Traducción de "show"
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "emptyTable": "No hay datos disponibles en la tabla" // Traducción de "No data available in table"
            }
        });
    })
</script>

</html>