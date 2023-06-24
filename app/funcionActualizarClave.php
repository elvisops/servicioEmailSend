<?php
include "./conexion.php"; 

if ((!isset($_POST['clave']) || $_POST['clave'] != "") && (!isset($_POST['clave2']) || $_POST['clave2'] != "")) {
    $claveLogin = $_POST['clave'];
    $longuitudContraseña = strlen($claveLogin);
    if (!($longuitudContraseña <= 7)) {
        // $claveLogin = $_POST['clave'];
        $expresion = "/([a-zA-Z0-9\.]+)+([a-zA-Z0-9\.])+([a-zA-Z0-9\.])/";
        if (preg_match($expresion, $claveLogin)) {
            if (!($_POST['clave'] != $_POST['clave2'])) {


                // date_default_timezone_set('America/Tegucigalpa');
                $usuarioid = $_POST['id'];
                // $claveLogin = $_POST['clave'];
                $hash = hash("sha512", $claveLogin);
                $claveLogin = $hash;
                $actualizacion = date("Y-m-d h:i:s");

                //valido si solicito el cambio de contraseña
                $sql = "SELECT USUARIOID FROM USUARIOS WHERE USUARIOID = :usuarioid AND RESETCLAVE = '1'";
                $statement = $conexion->prepare($sql);
                $statement->bindParam(':usuarioid', $usuarioid, PDO::PARAM_INT);
                $statement->execute();
                $id = $statement->fetch(PDO::FETCH_ASSOC);

                if ($statement->rowCount() > 0) {
                    $sql = 'UPDATE USUARIOS SET CLAVELOGIN = :claveLogin, RESETCLAVE = "0", ACTUALIZACION = :actualizacion 
                    WHERE USUARIOID = :usuarioid AND RESETCLAVE = "1"';

                    $statement = $conexion->prepare($sql);
                    $statement->bindParam(':claveLogin', $claveLogin, PDO::PARAM_STR);
                    $statement->bindParam(':actualizacion', $actualizacion, PDO::PARAM_STR);
                    $statement->bindParam(':usuarioid', $usuarioid, PDO::PARAM_INT);
                    $statement->execute();
                    $usuario = $statement->fetch(PDO::FETCH_ASSOC);


                    if ($statement->rowCount() > 0) {
                        echo 1;
                    } else {
                        echo "Ocurrio un error al actualizar la contraseña";
                    }
                } else {
                    echo "El usuario no ha solicitado ningún cambio de contraseña";
                }
            } else {
                echo "Ambas contraseñas deben coincidir";
            }
        } else {
            echo "La contraseña debe contener letras, números y al menos un punto";
        }
    } else {

        echo "La contraseña debe contener al menos 8 carcateres";
    }
} else {
    echo "Ingrese los datos solicitados";
}
