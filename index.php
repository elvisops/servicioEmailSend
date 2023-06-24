<?php
session_start();
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
    <title>Emailsend</title>
    <link rel="icon" type="image/jpg" href="./css/favicon.ico" />
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title text-center">Email Send</h3>
                        </div>
                        <form id="formLogin">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="mail">Correo Electrónico</label>
                                    <input type="email" class="form-control" name="mail" id="mail" placeholder="usuario@ops.com.hn" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="password" id="password" required>
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-info btn-flat" onclick="mostrarClaveLogin()">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="mensaje pb-3">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-primary" id="enviar">Iniciar Sesión</button>
                                <a class="btn btn-light" href="./registrar.php">Crear Cuenta</a>
                                <hr>
                                <div>
                                    <a href="recuperarClave.php" class="btn btn-link">¿Olvidaste tu contraseña?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script src="./js/funciones.js"></script>
<script src="./js/funcionesClaves.js"></script>

</html>