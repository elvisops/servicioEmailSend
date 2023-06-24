<?php
//al validar las credenciales se envia 2 veces
include "./app/conexion.php";
if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION['activo'] != true) {
    header("Location:index.php");
}

$id = $_SESSION['campoId'];
//validar el id que recibo
if (isset($_GET["id"])) {
    $usuarioId = $_GET["id"];
}

$query = "SELECT USUARIOID,NOMBRE,CORREOLOGIN,CLAVELOGIN,CORREOENVIO,CLAVEENVIO FROM USUARIOS WHERE USUARIOID = :id";
$stmt = $conexion->prepare($query);
$stmt->bindParam(":id", $usuarioId, PDO::PARAM_INT);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_OBJ);

$nombre = $_SESSION['campoNombre'];

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
</head>

<body>
    <?php require "navegacion.php" ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center pt-3">
                <div class="col-md-10">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Actualizar perfil de: <?php if ($usuario) echo $usuario->NOMBRE; ?></h3>
                        </div>
                        <form id="formRegistrarse" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="titulo">
                                            <h4>Datos de Sesión</h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre">Nombre completo</label>
                                            <input type="text" class="form-control" name="nombre" id="nombre" value="<?php if ($usuario) echo $usuario->NOMBRE; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="mail">Correo Electrónico</label>
                                            <input type="email" class="form-control" name="mail" id="mail" value="<?php if ($usuario) echo $usuario->CORREOLOGIN; ?>" placeholder="usuario@mail.com" required>
                                        </div>
                                        <!-- <h1>Ejemplo de eliminación o bloqueo de caracteres en tiempo real con máscara en JavaScript</h1>
                                        <input type="text" id="miInput" oninput="validarMascara(this)"> -->
                                        <div class="form-group">
                                            <label for="clave">Contraseña</label>
                                            <div class="input-group">
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
                                            <div class="input-group">
                                                <input type="password" class="form-control" name="clave2" id="clave2" required oninput="validarMascara(this)">
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-info btn-flat" onclick="mostrarClaveLoginVerificacion()">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </span>
                                            </div>

                                        </div>
                                        <div class="mensaje"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="titulo">
                                            <h4>Datos para envió de correos</h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="cuentaCorreo">Cuenta desde donde se enviara el correo</label>
                                            <input type="email" class="form-control" name="cuentaCorreo" id="cuentaCorreo" value="<?php if ($usuario) echo $usuario->CORREOENVIO; ?>" placeholder="nombre.apellido@ops.com.hn" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cuentaClave">Contraseña desde donde se enviara el correo</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" name="cuentaClave" id="cuentaClave" required>
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-info btn-flat" onclick="mostrarClaveEnvio()">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary" id="validarDatosActualizar">Validar credenciales</button>
                                            <div id="load">
                                                <i class="fa fa-refresh fa-spin" id="spin" aria-hidden="true"></i>
                                                <i class="fa fa-check" id="correcto" aria-hidden="true"></i>
                                                <i class="fa fa-times" id="incorrecto" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" id="actualizar">Actualizar</button>
                                <a href="correos.php" class="btn btn-danger" id="btnCancelar">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<div class="footer">
    <?php require("footer.php") ?>
</div>
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script src=" https://unpkg.com/sweetalert/dist/sweetalert.min.js "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
<script src="./js/funciones.js"></script>
<script src="./js/funcionesClaves.js"></script>

</html>