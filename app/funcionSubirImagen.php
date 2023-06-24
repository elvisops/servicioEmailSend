<?php

// echo (dirname(__FILE__)); 
if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_FILES['uploadedfile']['name'])) {
    $explode_name = explode('.', $_FILES['uploadedfile']['name']);
    if (
        $explode_name[1] == 'png' || $explode_name[1] == 'PNG' ||
        $explode_name[1] == 'jpg' || $explode_name[1] == 'JPG' ||
        $explode_name[1] == 'jpeg' || $explode_name[1] == 'JPEG'
    ) {
        $path = "../imagenes/";
        $carpeta = $_SESSION['campoId'];
        $nombreArchivo = "imagen";
        $idUsuario = $_SESSION['campoId'];
        $extension = ".png";
        $carpeta = $path . $carpeta;
        $ruta = $carpeta ."/" . $nombreArchivo . $extension;

        // if (file_exists($path)) {
            // echo $carpeta;
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }
            // unlink($path);

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
    echo "Por favor seleccione una imagen";
}
