<?php
    
    include("./conexion.php"); //$conexion

    if (isset($_POST['mail']) && !empty($_POST['mail']) && isset($_POST['password']) && !empty($_POST['password'])) {
        $correo = $_POST["mail"];
        $correo = strtolower($correo);
        $clave = $_POST["password"];
        $hash = hash("sha512", $clave);
        $clave = $hash;

        $statement = $conexion->prepare('SELECT * FROM USUARIOS WHERE CORREOLOGIN= :correo and CLAVELOGIN= :clave;');
        $statement->bindParam(':correo', $correo, PDO::PARAM_STR);
        $statement->bindParam(':clave', $clave, PDO::PARAM_STR);
        $statement->execute();
        $usuario = $statement->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            session_start();
            $_SESSION['activo'] = true;
            $_SESSION['campoMail'] = $usuario["CORREOENVIO"];
            $_SESSION['campoClave'] = $usuario["CLAVEENVIO"];
            $_SESSION['campoId'] = $usuario["USUARIOID"];
            $_SESSION['campoNombre'] = $usuario["NOMBRE"];
            // echo json_encode($usuario);
            // echo 1;
            echo json_encode([1, "Usuario Valido", $usuario]);
            //  header('Location: index.php');
        }else{
            echo json_encode([0, "Usuario o contraseña incorrectas", 0]);
        }
    }else{
        echo json_encode([0,"Ingrese los datos solicitados", 0]);
    }
?>