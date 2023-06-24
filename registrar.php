<?php
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
    <title>Emailsend</title>
    <link rel="icon" type="image/jpg" href="./css/favicon.ico" />
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">



</head>

<body>
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- left column -->
                <div class="col-md-10">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Crear cuenta</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <!-- <form action="FuncionesLogin.php" id='formLogin' method="POST"> -->
                        <form id="formRegistrarse" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="titulo">
                                            <h4>Datos de Sesión</h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre">Nombre completo</label>
                                            <input type="text" class="form-control" name="nombre" id="nombre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="mail">Correo Electrónico</label>
                                            <input type="email" class="form-control" name="mail" id="mail" placeholder="usuario@mail.com" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="clave">Contraseña</label>
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control" name="clave" id="clave" required oninput="validarMascara(this)">
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-info btn-flat" onclick="mostrarClaveLoginVerificacion()">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </span>
                                            </div>
                                            <div id="error" style="color:red;"></div>
                                            <!-- <p id="resultado"></p> -->
                                            <div id="resultado" class="pt-2"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="clave">Confirmar Contraseña</label>
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
                                    <div class="col-md-6">
                                        <div class="titulo">
                                            <h4>Datos para envió de correos</h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="cuentaCorreo">Cuenta desde donde se enviara el correo</label>
                                            <input type="email" class="form-control" name="cuentaCorreo" id="cuentaCorreo" placeholder="nombre.apellido@mail.com" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cuentaClave">Contraseña desde donde se enviara el correo</label>
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control" name="cuentaClave" id="cuentaClave" required>
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-info btn-flat" onclick="mostrarClaveEnvio()">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-success" id="validarDatosRegistrarse">Validar credenciales</button>
                                            <div id="load">
                                                <i class="fa fa-refresh fa-spin" id="spin" aria-hidden="true"></i>
                                                <i class="fa fa-check" id="correcto" aria-hidden="true"></i>
                                                <i class="fa fa-times" id="incorrecto" aria-hidden="true"></i>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- <p>Ingresa un carácter:</p>
                                <input type="text" id="miInput"> -->
                                <!-- <p id="resultado"></p> -->

                            </div>

                            <div class="card-footer">
                                <button class="btn btn-primary" id="registrarse">Registrarse</button>
                                <a class="btn btn-light" href="index.php" id="tengoUnaCuenta">Ya tengo una cuenta</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script> -->
<script src="./js/funciones.js"></script>
<script src="./js/funcionesClaves.js"></script>

</html>