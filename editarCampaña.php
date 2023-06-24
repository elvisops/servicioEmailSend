<?php
//listo
include "./app/conexion.php";
if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION['activo'] != true) {
    header("Location:index.php");
}

$usuarioId = $_SESSION['campoId'];

if (isset($_GET["id"])) {
    $campañaId = $_GET["id"];

    //traigo el nombre de la campaña
    $query = "SELECT NOMBRES,IMAGEN FROM NOMBRESGRUPOSEXCEL WHERE NGEID = :id";
    $stmt = $conexion->prepare($query);

    //llamado por referencia pdo php
    $stmt->bindParam(":id", $campañaId, PDO::PARAM_INT);
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_OBJ);

    if ($stmt->rowCount() > 0) {
        $campaña = $resultado->NOMBRES;
        $rutaImg = $resultado->IMAGEN;
    } else {
        $campaña = "";
    }
    // $carpeta = str_replace(' ', '', $campaña);
    // $rutaImg2 = "./imagenes/" . $carpeta . "\imagen.png";
    // echo $rutaImg2;
}

// $ruta = "historicoCampañas.php?id=" . $usuarioId;
$ruta = "./correos.php"
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <?php require "navegacion.php" ?>
    <div class="container-fluid">
        <div class="row justify-content-center pt-3">
            <div class="col-md-10">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="card-title">
                            <h3>
                                <a href="<?php echo $ruta; ?>" style="text-decoration: none;">
                                    <i class="fa fa-arrow-left text-primary" aria-hidden="true"></i>
                                </a> Editar campaña
                            </h3>
                        </div>
                    </div>
                    <form id="formEditarCampaña" method="POST">
                        <div class="row">
                            <div class="col-md-12 pt-3" style="padding-left: 30px;">
                                <div class="form-group">
                                    <div style="color:red; position:absolute;" class="mensajeCampaña" id="mensajeCampaña" name="mensajeCampaña"></div>
                                </div>
                            </div>
                            <div class="col-md-6 pt-3">
                                <input type="hidden" id="idCampaña" name="idCampaña" value="<?php echo  $campañaId ?>">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nombreCampaña">Nombre campaña</label>
                                        <input type="text" class="form-control" name="nombreCampaña" id="nombreCampaña" value="<?php if (isset($resultado->NOMBRES)) echo $campaña; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12 pt-3">
                                    <div>
                                        <label for="uploadedfile">Imagen para la plantilla de correos</label>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-md-7"> -->
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="uploadedfile" id="uploadedfile" class="custom-file-input" accept="image/png,image/jpeg" />
                                            <!-- <label for="file-input" class="custom-file-label">
                                                Seleccione la imagen
                                            </label> -->
                                            <label for="file-input" class="custom-file-label" id="textoImg">
                                                No se ha seleccionado ningún archivo.
                                            </label>
                                        </div>
                                    </div>
                                    <!-- </div>
                                    </div> -->
                                    <!-- <div class="col-md-12"> -->

                                    <!-- </div> -->

                                </div>
                            </div>
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12 pt-3">
                                    <div class="text-center">
                                        <img class="imgPrevisualizacion" id="imgPrevisualizacion">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer mt-3">
                            <div class="form-group">
                                <button class="btn btn-primary" id="actualizarCampaña">Actualizar</button>
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script src="./js/funciones.js"></script>
<script src="./js/funcionesVisualizarImagen.js"></script>
