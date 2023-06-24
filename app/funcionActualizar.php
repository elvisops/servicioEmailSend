<?php
include('./conexion.php');
include('./funcionesEncrypt.php');

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['credencialesV']) && $_SESSION['credencialesV'] == true) {
    if ((!isset($_POST['nombre']) || $_POST['nombre'] != "") &&
        (!isset($_POST['mail']) || $_POST['mail'] != "") &&
        (!isset($_POST['clave']) || $_POST['clave'] != "") &&
        (!isset($_POST['clave2']) || $_POST['clave2'] != "") &&
        (!isset($_POST['cuentaClave']) || $_POST['cuentaClave'] != "")
    ) {

        if (isset($_SESSION['campoId'])) {
            $usuarioid = $_SESSION['campoId'];
        } else {
            $usuarioid = 0;
        }
        $correoLogin = $_POST['mail'];
        $correoLogin = strtolower($correoLogin);
        $clave = $_POST['cuentaClave'];

        $sql = 'SELECT USUARIOID,CORREOENVIO FROM USUARIOS WHERE CORREOLOGIN = :correoLogin';
        $statement = $conexion->prepare($sql);
        $statement->bindParam(':correoLogin', $correoLogin, PDO::PARAM_STR);
        $statement->execute();
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);

        if ($statement->rowCount() > 0 && $resultado['USUARIOID'] != $usuarioid) {
            echo 'Ya existe el correo ' . $correoLogin . ', no se permiten registros duplicados';
        } elseif (($statement->rowCount() > 0 && $resultado['USUARIOID'] == $usuarioid) ||
            ($statement->rowCount() <= 0)
        ) {
            $claveLogin = $_POST['clave'];
            $longuitudContraseña = strlen($claveLogin);
            if (!($longuitudContraseña <= 7)) {
                // $claveLogin = $_POST['clave'];
                $expresion = "/([a-zA-Z0-9\.]+)+([a-zA-Z0-9\.])+([a-zA-Z0-9\.])/";
                if (preg_match($expresion, $claveLogin)) {
                    if (!($_POST['clave'] != $_POST['clave2'])) {

                        date_default_timezone_set('America/Tegucigalpa');
                        $usuarioid = $_SESSION['campoId'];
                        $nombre = $_POST['nombre'];
                        // $correoLogin = $_POST['mail'];
                        $claveLogin = $_POST['clave'];
                        $hash = hash("sha512", $claveLogin);
                        $claveLogin = $hash;
                        $correoEnvio = $_POST['cuentaCorreo'];
                        $claveEnvio = $_POST['cuentaClave'];
                        $hash = encrypt($claveEnvio);
                        $claveEnvio = $hash;
                        $actualizacion = date("Y-m-d h:i:s");


                        $sql = 'UPDATE USUARIOS SET NOMBRE = :nombre, CORREOLOGIN = :correoLogin, CLAVELOGIN = :claveLogin,
                         CORREOENVIO = :correoEnvio, CLAVEENVIO = :claveEnvio, ACTUALIZACION = :actualizacion WHERE USUARIOID = :usuarioid';

                        $statement = $conexion->prepare($sql);
                        $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                        $statement->bindParam(':correoLogin', $correoLogin, PDO::PARAM_STR);
                        $statement->bindParam(':claveLogin', $claveLogin, PDO::PARAM_STR);
                        $statement->bindParam(':correoEnvio', $correoEnvio, PDO::PARAM_STR);
                        $statement->bindParam(':claveEnvio', $claveEnvio, PDO::PARAM_STR);
                        $statement->bindParam(':actualizacion', $actualizacion, PDO::PARAM_STR);
                        $statement->bindParam(':usuarioid', $usuarioid, PDO::PARAM_INT);
                        $statement->execute();
                        $usuario = $statement->fetch(PDO::FETCH_ASSOC);

                        // echo $nombre." ".$correoLogin." ".$claveLogin." ".$correoEnvio." ".$claveEnvio." ".$actualizacion." ".$usuarioid;
                        // return;
                        if ($statement->rowCount() > 0) {
                            $_SESSION['campoNombre'] =  $nombre;
                            echo 1;
                        } else {
                            echo "Ocurrio un error al actualizar el usuario";
                        }
                    } else {
                        echo "Las contraseñas deben coincidir";
                    }
                } else {
                    echo "La contraseña debe contener letras, números y al menos un punto";
                }
            } else {
                echo "La contraseña debe contener al menos 8 caracteres";
            }
        }
    } else {
        echo "Por favor ingrese los datos solicitados";
    }
} else {
    echo "Debe ingresar una cuenta de correo valida para el envio de correos electronicos";
}
