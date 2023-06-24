<?php

if (!isset($_SESSION)) {
    session_start();
}
include('./conexion.php');

$campañaId = $_POST["idCampaña"];
$campaña = $_POST["nombreCampaña"];
$campaña = trim($campaña);


if ($campaña == "" || !isset($campaña)) {
    echo "Ingrese el nombre de la campaña";
    return;
}

if (empty($_FILES['uploadedfile']['name'])) {
    echo "Por favor seleccione una imagen";
    return;
}
$path = "./imagenes/";
$carpeta = $_POST['nombreCampaña'];
$carpeta = str_replace(' ', '', $carpeta);
// $cadena_sin_espacios = str_replace(' ', '', $cadena);
$nombreArchivo = "imagen";
$idUsuario = $_SESSION['campoId'];
$extension = ".png";
$carpeta = $path . $carpeta;
$ruta = $carpeta . "/" . $nombreArchivo . $extension;
// echo $ruta;
// return;

$sql = 'UPDATE NOMBRESGRUPOSEXCEL SET NOMBRES = :nombres, IMAGEN = :rutaImg WHERE NGEID = :id;';
$statement = $conexion->prepare($sql);
$statement->bindParam(':nombres', $campaña, PDO::PARAM_STR);
$statement->bindParam(':rutaImg', $ruta, PDO::PARAM_STR);
$statement->bindParam(':id', $campañaId, PDO::PARAM_INT);
$statement->execute();
// $resultado = $statement->fetch(PDO::FETCH_ASSOC);

if ($statement) {
    if (!empty($_FILES['uploadedfile']['name'])) {
        $en = explode('.', $_FILES['uploadedfile']['name']);
        if (
            $en[1] == 'png' || $en[1] == 'PNG' ||
            $en[1] == 'jpg' || $en[1] == 'JPG' ||
            $en[1] == 'jpeg' || $en[1] == 'JPEG'
        ) {
            $path = "../imagenes/";
            $carpeta = $_POST['nombreCampaña'];
            $carpeta = str_replace(' ', '', $carpeta);
            // $cadena_sin_espacios = str_replace(' ', '', $cadena);
            $nombreArchivo = "imagen";
            $idUsuario = $_SESSION['campoId'];
            $extension = ".png";
            $carpeta = $path . $carpeta;
            $ruta = $carpeta . "/" . $nombreArchivo . $extension;
            // echo $ruta;
            // return;

            // if (file_exists($path)) {
            // echo $carpeta;
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }
            // 
            if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $ruta)) {
                echo 1;
            } else {
                echo "Ha ocurrido un error, trate de nuevo!";
            }
            // echo $path;
            // }
        } else {
            echo "El archivo seleccionado no es una imagen valida";
        }
    } else {
        echo 1;
    }
} else {
    echo "Ocurrio un error al actualizar la campaña";
}

// return;

// if (!empty($_FILES['uploadedfile']['name'])) {
//     $explode_name = explode('.', $_FILES['uploadedfile']['name']);
//     if (
//         $explode_name[1] == 'png' || $explode_name[1] == 'PNG' ||
//         $explode_name[1] == 'jpg' || $explode_name[1] == 'JPG' ||
//         $explode_name[1] == 'jpeg' || $explode_name[1] == 'JPEG'
//     ) {
//         $path = "../imagenes/";
//         $carpeta = $_SESSION['campoId'];
//         $nombreArchivo = "imagen";
//         $idUsuario = $_SESSION['campoId'];
//         $extension = ".png";
//         $carpeta = $path . $carpeta;
//         $ruta = $carpeta . "/" . $nombreArchivo . $extension;

//         // if (file_exists($path)) {
//         // echo $carpeta;
//         if (!file_exists($carpeta)) {
//             mkdir($carpeta, 0777, true);
//         }
//         // unlink($path);

//         if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $ruta)) {
//             echo 1;
//         } else {
//             echo "Ha ocurrido un error, trate de nuevo!";
//         }
//         // echo $path;
//         // }
//     } else {
//         echo "El archivo seleccionado no es una imagen valida";
//     }
// } else {
//     echo "Por favor seleccione una imagen";
// }
