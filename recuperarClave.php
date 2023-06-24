<?php
if (!isset($_SESSION)) {
    session_start();
}

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
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center pt-3">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Recuperar contraseña</h3>
                        </div>
                        <form id="formRecuperarClave">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="mail">Correo Electrónico</label>
                                    <input type="email" class="form-control" name="mail" id="mail" placeholder="nombre@mail.com" required>
                                </div>
                                <div class="mensaje pb-3">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" id="recuperarClave">Enviar</button>
                                <a class="btn btn-danger" href="index.php" id="cancelar">Cancelar</a>
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