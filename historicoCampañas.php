<?php
// listo
include('./app/conexion.php');

if (!isset($_SESSION['campoId'])) {
    session_start();
}
$usuarioId = $_SESSION['campoId'];

$query = "SELECT NG.NGEID AS NGEID, NG.NOMBRES AS NOMBRE, 
NG.USUARIOID AS USUARIOID, SC.ESTADO AS ESTADO, NG.ESTADO AS ESTADOCAMPAÑA 
FROM NOMBRESGRUPOSEXCEL NG
INNER JOIN SOLICITUDENVIARCORREOS SC
ON NG.NGEID = SC.NGEID
WHERE NG.USUARIOID = :usuarioId AND (SC.ESTADO = 'X' OR SC.ESTADO = 'E');";
$stmt = $conexion->prepare($query);
$stmt->bindParam(":usuarioId", $usuarioId, PDO::PARAM_INT);
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
$stmt->closeCursor();

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <?php require "navegacion.php" ?>
    <div class="container-fluid">
        <div class="row justify-content-center pt-3">
            <div class="col-md-12">
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Campañas enviadas</h3>
                                    </div>
                                    <div class="card-body">
                                        <table id="example2" class="table table-bordered table-hover table-auto-size">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th style="width:10%">Estado</th>
                                                    <th style="width:30%">Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (isset($resultado)) { ?>
                                                    <?php foreach ($resultado as $fila) { ?>
                                                        <tr>
                                                            <td><?php echo $fila->NOMBRE; ?></td>
                                                            <td class="text-center">
                                                                <?php
                                                                // echo $fila->ESTADO;
                                                                if ($fila->ESTADOCAMPAÑA == 'I') {
                                                                    echo 'Inactiva';
                                                                } else {
                                                                    if ($fila->ESTADO == 'I') {
                                                                        echo 'Pendiente';
                                                                    } elseif ($fila->ESTADO == 'A' || $fila->ESTADO == 'E') {
                                                                        echo 'Enviando';
                                                                    } elseif ($fila->ESTADO == 'X') {
                                                                        echo 'Enviados';
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <a class="w btn btn-info" href="./correosCampañas.php?id=<?php echo $fila->NGEID; ?>">
                                                                    Detalles
                                                                </a>
                                                                <?php
                                                                if ($fila->ESTADOCAMPAÑA != 'A') {
                                                                    $soloLectura = "opacity: 0.5;pointer-events: none;";
                                                                } else {
                                                                    $soloLectura = "";
                                                                }

                                                                ?>
                                                                <a style="<?php echo $soloLectura; ?>" class="w btn btn-warning" onclick="eliminarCampaña(this)" data-id="<?php echo $fila->NGEID; ?>" name="eliminarCampaña" id="eliminarCampaña" type="submit">
                                                                    Inactivar
                                                                </a>
                                                                <!-- <a class="w btn btn-danger" data-id="<?php echo $fila->NGEID; ?>" name="eliminarCampaña" id="eliminarCampaña" type="submit">
                                                                    Borrar
                                                                </a> -->
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- </div>
    </div> -->
</body>

<div class="footer">
    <?php require("footer.php") ?>
</div>
<!-- jquery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script src="js/funciones.js"></script>
<script>
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
    });
</script>

</html>