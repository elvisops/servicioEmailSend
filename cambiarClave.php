<?php
$usuarioId =  $_GET['id'];

if (!isset($_SESSION)) {
    session_start();
}

// session_start();
if (isset($_SESSION['activo'])) {
    header("Location:./correos.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurar Contraseña</title>
    <link rel="icon" type="image/jpg" href="./css/favicon.ico" />
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <section class="content mt-3">
        <div class="container-fluid">
            <div class="row justify-content-center pt-3">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <form id="formRestaurarClave">
                            <div class="card-body">
                                <div class="titulo">
                                    <h4>Cambiar Contraseña</h4>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $usuarioId ?>">
                                <div class="form-group">
                                    <label for="clave">Nueva Contraseña</label>
                                    <!-- <input type="password" class="form-control" name="clave" id="clave" required> -->
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="clave" id="clave" required oninput="validarMascara(this)">
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-info btn-flat" onclick="mostrarClaveLoginVerificacion()">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div id="error" style="color:red;"></div>
                                    <div id="resultado" class="pt-2"></div>
                                </div>
                                <div class="form-group">
                                    <label for="clave">Confirmar Contraseña</label>
                                    <!-- <input type="password" class="form-control" name="clave2" id="clave2" required> -->
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="clave2" id="clave2" required oninput="validarMascara(this)">
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-info btn-flat" onclick="mostrarClaveLoginVerificacion()">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="mensaje">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" id="actualizarClave">Actualizar</button>
                                <a href="index.php" class="btn btn-danger">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<!-- <script src="https://code.jquery.com/jquery-3.6.3.js"></script> -->
<script src="./plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script src=" https://unpkg.com/sweetalert/dist/sweetalert.min.js "></script>
<script src="./js/funciones.js"></script>
<script src="./js/funcionesClaves.js"></script>

</html>