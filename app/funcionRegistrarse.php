<?php
include('./conexion.php');
include('./funcionesEncrypt.php');
session_start();


if (isset($_SESSION['credencialesV']) && $_SESSION['credencialesV'] == true) {
    if ((!isset($_POST['nombre']) || $_POST['nombre'] != "") &&
        (!isset($_POST['mail']) || $_POST['mail'] != "") &&
        (!isset($_POST['clave']) || $_POST['clave'] != "") &&
        (!isset($_POST['clave2']) || $_POST['clave2'] != "") &&
        (!isset($_POST['cuentaClave']) || $_POST['cuentaClave'] != "")
    ) {

        $correoLogin = $_POST['mail'];
        $correoLogin = strtolower($correoLogin);
        $sql = 'SELECT CORREOLOGIN FROM USUARIOS WHERE CORREOLOGIN = :correoLogin';
        $statement = $conexion->prepare($sql);
        $statement->bindParam(':correoLogin', $correoLogin, PDO::PARAM_STR);
        $statement->execute();
        $correo = $statement->fetch(PDO::FETCH_ASSOC);

        // echo ($correo->rowCount()) ;
        if ($correo) {
            echo "Ya existe el correo: ".$correoLogin.", no se permiten registros duplicados";
        } else {
            $claveLogin = $_POST['clave'];
            $longuitudContraseña = strlen($claveLogin);
            if (!($longuitudContraseña <= 7)) {
                // $claveLogin = $_POST['clave'];
                $expresion = "/([a-zA-Z0-9\.]+)+([a-zA-Z0-9\.])+([a-zA-Z0-9\.])/";

                if (preg_match($expresion, $claveLogin)) {
                    if (!($_POST['clave'] != $_POST['clave2'])) {

                        $nombre = $_POST['nombre'];
                        // $correoLogin = $_POST['mail'];
                        $claveLogin = $_POST['clave'];
                        $hash = hash("sha512", $claveLogin);
                        $claveLogin = $hash;
                        $correoEnvio = $_POST['cuentaCorreo'];
                        $correoEnvio = strtolower($correoEnvio);
                        $claveEnvio = $_POST['cuentaClave'];
                        $hash = encrypt($claveEnvio);
                        $claveEnvio = $hash;


                        $sql = 'INSERT INTO USUARIOS(NOMBRE, CORREOLOGIN, CLAVELOGIN, CORREOENVIO, CLAVEENVIO) 
                        VALUES (:nombre, :correoLogin, :claveLogin, :correoEnvio, :calveEnvio)';

                        $statement = $conexion->prepare($sql);
                        $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                        $statement->bindParam(':correoLogin', $correoLogin, PDO::PARAM_STR);
                        $statement->bindParam(':claveLogin', $claveLogin, PDO::PARAM_STR);
                        $statement->bindParam(':correoEnvio', $correoEnvio, PDO::PARAM_STR);
                        $statement->bindParam(':calveEnvio', $claveEnvio, PDO::PARAM_STR);
                        $statement->execute();
                        $usuario = $statement->fetch(PDO::FETCH_ASSOC);
 

                        if ($statement->rowCount() > 0) {
                            echo json_encode([1,"Usuario creado correctamente!",$usuario]);
                        } else {
                            echo json_encode([0,"Ocurrió un error al guardar el registro",null]);
                        }
                    } else {
                        echo json_encode([0,"Las contraseñas deben coincidir",null]);
                    }
                } else {
                    echo json_encode([0,"La contraseña debe contener letras, números y al menos un punto",null]);
                }
            } else {
                echo json_encode([0,"La contraseña debe contener al menos 8 caracteres",null]);
            }
        }
    } else {
        echo json_encode([0,"Por favor ingrese los datos solicitados",null]);
    }
} else {
    echo json_encode([0,"Debe ingresar una cuenta de correo valida para el envio de correos electronicos",null]);
}
