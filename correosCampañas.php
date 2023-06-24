<?php
// listo
include('./app/conexion.php');
if (isset($_GET['id'])) {
    if (!isset($_SESSION['campoId'])) {
        session_start();
    }
    $usuarioId = $_SESSION['campoId'];
    $grupoId = $_GET['id'];

    //traigo los correos de la campaña
    $query = "SELECT C.CORREOID AS CORREOID, C.NOMBRE AS NOMBRE, C.CORREO AS CORREO, C.ESTADO AS ESTADO,
    C.CREACION AS CREACRION, C.ACTUALIZACION AS ACTUALIZACION FROM USUARIOSCORREOS UC
    INNER JOIN CORREOS C
    ON UC.CORREOID = C.CORREOID
    WHERE UC.NGEID = :grupoId AND UC.USUARIOID = :usuarioId";
    $stmt = $conexion->prepare($query);
    $stmt->bindParam(":grupoId", $grupoId, PDO::PARAM_INT);
    $stmt->bindParam(":usuarioId", $usuarioId, PDO::PARAM_INT);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
    $stmt->closeCursor();

    //traigo el nombre de la campaña
    $query = "SELECT NOMBRES FROM NOMBRESGRUPOSEXCEL WHERE NGEID = :id";
    $stmt = $conexion->prepare($query);
    $stmt->bindParam(":id", $grupoId, PDO::PARAM_INT);
    $stmt->execute();
    $nombre = $stmt->fetch(PDO::FETCH_OBJ);
    $stmt->closeCursor();
}

$ruta = "./correos.php";


// Logica para mostrar grafico
$json = json_encode($resultado);
// Convertir JSON a array asociativo
$data = json_decode($json, true);

// Inicializar variables para acumular los estados
$n = 0;
$e = 0;
$p = 0;

// Recorrer el array y contar los estados
foreach ($data as $row) {
    switch ($row['ESTADO']) {
        case 'N':
            $n++;
            break;
        case 'E':
            $e++;
            break;
        case 'P':
            $p++;
            break;
    }
}

// Crear un array con los totales de cada estado
$totals = array(
    array('Estado', 'Total'),
    array('No Enviado', $n),
    array('Enviado', $e),
    array('Pendiente', $p)
);

// Convertir el array a JSON
$json_totals = json_encode($totals);

// Mostrar el gráfico


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
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

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
                                        <h3 class="card-title">
                                            <a href="#" onclick="history.back()" style="text-decoration: none;">
                                                <i class="fa fa-arrow-left text-primary" aria-hidden="true"></i>
                                            </a> Correos de la campaña: <?php if (isset($nombre->NOMBRES)) {
                                                                            echo $nombre->NOMBRES;
                                                                        } ?>
                                            <i style="float: right" onclick="location.reload()" class="fa fa-refresh text-primary" aria-hidden="true" title="Recargar"></i>
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <!-- <button id="descargarExcel">Descargar Excel</button> -->
                                        <!-- <div class="pb-3 float-right">
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" title="Vista Previa">
                                                Grafico
                                            </button>
                                        </div> -->

                                        <div class="table-responsive">
                                            <table id="example2" class="table table-bordered table-hover table-auto-size display nowrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nombre</th>
                                                        <th>Correo</th>
                                                        <th>Estado</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (isset($resultado)) {
                                                        $i = 1;
                                                    ?>
                                                        <?php foreach ($resultado as $fila) { ?>
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
                                                                <td><?php echo $fila->NOMBRE; ?></td>
                                                                <td> <?php echo $fila->CORREO; ?></td>
                                                                <td class="text-center">
                                                                    <?php
                                                                    if ($fila->ESTADO == 'E') {
                                                                        // echo 'Enviado';
                                                                        echo '<p style="background-color: blue; padding:5px; color:white; width: 100px; display: block; margin: 0 auto; border-radius: 5px;">Enviado</p>';
                                                                    } elseif ($fila->ESTADO == 'N') {
                                                                        // echo 'No Enviado';
                                                                        echo '<p style="background-color: red; padding:5px; color:white; width: 100px; display: block; margin: 0 auto; border-radius: 5px;">No Enviado</p>';
                                                                    } else {
                                                                        // echo 'Pendiente';
                                                                        echo '<p style="background-color: green; padding:5px; color:white; width: 100px; display: block; margin: 0 auto; border-radius: 5px;">Pendiente</p>';
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                            $i++;
                                                        } ?>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                            <!-- <div id="chart_div" style="width: 900px; height: 500px;"></div> -->

                                            <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                            <script type="text/javascript">
                                                google.charts.load('current', {
                                                    'packages': ['corechart']
                                                });
                                                google.charts.setOnLoadCallback(drawChart);

                                                function drawChart() {
                                                    var data = google.visualization.arrayToDataTable(<?php echo $json_totals; ?>);

                                                    var options = {
                                                        title: 'Totales por estado',
                                                        pieHole: 0.4,
                                                        colors: ['red', 'blue', 'green'],
                                                    };

                                                    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                                                    chart.draw(data, options);
                                                }
                                            </script> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- ventana modal -->
    <div class="modal fade" id="modalGrafico" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <!-- <div class="col-12 col-sm-6 col-md-8 col-lg-9 col-xl-10">...</div> -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Estado de los correos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <body>
                        <div id="chart_div" style="margin-bottom: -20px;"></div>
                    </body>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</body>
<div class="footer">
    <?php require("footer.php") ?>
</div>
<!-- jquery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- datatables -->
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.js"></script>
<!-- <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.js"></script> -->
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<!-- chart.js -->
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo $json_totals; ?>);

        var options = {
            title: 'Totales por estado',
            is3D: true, // Habilitar gráfico en 3D
            pieHole: 0.4,
            colors: ['red', 'blue', 'green'],
            width: 450,
            height: 350,
            chartArea: { // Ajustar el área del gráfico para eliminar el padding en la parte inferior
                top: 5,
                bottom: 0,
                left: 5,
                right: 5
            }
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>


<script src="js/funciones.js"></script>
<script>
    $(document).ready(function() {
        $('#example2').DataTable({
            "dom": '<"top"Bf>rt<"bottom"lip><"clear">', // Agrega la opción de longitud de página en el DOM personalizado
            "buttons": [
                // {
                //     extend: 'copyHtml5',
                //     text: 'Copiar', 
                //     init: function(api, node, config) {
                //         $(node).addClass('btn btn-secondary') // Remover la clase de estilo predeterminada de DataTables
                //     }
                // },
                {
                    extend: 'excelHtml5',
                    text: 'Exportar Excel',
                    init: function(api, node, config) {
                        $(node).addClass('btn btn-success') // Remover la clase de estilo predeterminada de DataTables
                    }
                },
                // {
                //     extend: 'csvHtml5',
                //     text: 'Exportar CSV',
                //     init: function(api, node, config) {
                //         $(node).addClass('btn btn-warning') // Remover la clase de estilo predeterminada de DataTables
                //     }
                // },
                {
                    extend: 'pdfHtml5',
                    text: 'Exportar PDF',
                    init: function(api, node, config) {
                        $(node).addClass('btn btn-danger') // Remover la clase de estilo predeterminada de DataTables
                    }
                },
                {
                    text: 'Grafico',
                    className: 'btn btn-info',
                    titleAttr: 'Vista Previa',
                    action: function(e, dt, node, config) {
                        $('#modalGrafico').modal('show');
                    }
                }
            ],
            "pageLength": 10,
            "lengthMenu": [10, 20, 50, 100],
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