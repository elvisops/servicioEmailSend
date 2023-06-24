<?php
include './conexion.php';

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_POST['nombreCampaña']) || $_POST['nombreCampaña'] == "") {
    echo "Por favor ingrese el nombre de la campaña";
    return;
}

if (strlen($_POST['nombreCampaña']) < 5) {
    echo "El nombre debe contener al menos 5 caracteres";
    return;
}

// Función para remover acentos
function quitar_acentos($cadena)
{
    // Remover acentos
    $cadena = str_replace(
        array('Á', 'É', 'Í', 'Ó', 'Ú', 'á', 'é', 'í', 'ó', 'ú'),
        array('A', 'E', 'I', 'O', 'U', 'a', 'e', 'i', 'o', 'u'),
        $cadena
    );
    // Convertir Ñ y ñ
    $cadena = str_replace(
        array('Ñ', 'ñ'),
        array('N', 'n'),
        $cadena
    );
    return $cadena;
};


$nombreArchivo = $_FILES['dataCliente']['name'];

// Ruta al archivo CSV
$archivoExcel = $_FILES['dataCliente']['tmp_name'];

// Abrir el archivo en modo lectura
$excel = fopen($archivoExcel, 'r');

// Contador de filas
$numFilas = 0;

// Leer las filas del archivo
while (($fila = fgetcsv($excel)) !== FALSE) {
    // Incrementar el contador de filas
    $numFilas++;
    
    // Salir del bucle si se encuentran al menos dos filas
    if ($numFilas >= 2) {
        break;
    }
}

// Cerrar el archivo
fclose($excel);

// Verificar si hay al menos dos filas
if ($numFilas < 2) {
    echo "El excel está vacío, valide la información.";
    return;
} 


if (empty($_FILES['dataCliente']['name'])) {
    echo 'Seleccione el archivo Excel';
    return;
}

$tipo = $_FILES['dataCliente']['type'];
$tamanio = $_FILES['dataCliente']['size'];
$archivotmp = $_FILES['dataCliente']['tmp_name'];
$clienteId = $_SESSION['campoId'];

$explode_name = explode('.', $_FILES['dataCliente']['name']);
//valido que se un archivo .csv
if ($explode_name[1] == 'csv') {

    //valido que seleccione una imagen
    if (empty($_FILES['uploadedfile']['name'])) {
        echo "Por favor seleccione una imagen";
        return;
    }

    //seteo las variables
    $usuarioId = $_SESSION['campoId'];
    $nombreExcel = $_POST['nombreCampaña'];

    //Valido que no hayan campañas con el mismo nombre
    $sql = 'SELECT NGEID FROM NOMBRESGRUPOSEXCEL WHERE NOMBRES = :nombreExcel AND USUARIOID = :usuarioId LIMIT 1;';

    $statement = $conexion->prepare($sql);
    $statement->bindParam(':nombreExcel', $nombreExcel, PDO::PARAM_STR);
    $statement->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
    $statement->execute();
    $resultado = $statement->fetch(PDO::FETCH_OBJ);
    $statement->closeCursor();
    // echo "No Llegue";
    // return;
    if ($statement->rowCount() <= 0) {
        $en = explode('.', $_FILES['uploadedfile']['name']);
        if (
            $en[1] == 'png' || $en[1] == 'PNG' ||
            $en[1] == 'jpg' || $en[1] == 'JPG' ||
            $en[1] == 'jpeg' || $en[1] == 'JPEG'
        ) {
            $path = "./imagenes/" . $usuarioId . "/";
            $carpeta = $_POST['nombreCampaña'];
            $carpeta = str_replace(' ', '', $carpeta);
            // $cadena_sin_espacios = str_replace(' ', '', $cadena);
            $nombreArchivo = "imagen";
            $idUsuario = $_SESSION['campoId'];
            $extension = ".png";
            $carpeta = $path . $carpeta;
            $ruta = $carpeta . "/" . $nombreArchivo . $extension;

            if (!file_exists("." . $carpeta)) {
                mkdir("." . $carpeta, 0777, true);
            }

            if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], "." . $ruta)) {
                //creo la campaña
                $sql = 'INSERT INTO NOMBRESGRUPOSEXCEL(NOMBRES, USUARIOID,IMAGEN) 
                VALUES (:nombreExcel, :usuarioId, :imagen);';

                $statement = $conexion->prepare($sql);
                $statement->bindParam(':nombreExcel', $nombreExcel, PDO::PARAM_STR);
                $statement->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
                $statement->bindParam(':imagen', $ruta, PDO::PARAM_STR);
                $statement->execute();
                $resultado = $statement->fetch(PDO::FETCH_OBJ);
                $statement->closeCursor();


                if ($statement->rowCount() > 0) {
                    //ultimo id insertado en la tabla NOMBRESGRUPOSEXCEL
                    $idNombreExcel = ($conexion->lastInsertId());

                    $sql = "INSERT INTO SOLICITUDENVIARCORREOS(USUARIOID, NGEID) 
                    VALUES (:usuarioId, :idNombreExcel);";

                    $statement = $conexion->prepare($sql);
                    $statement->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
                    $statement->bindParam(':idNombreExcel', $idNombreExcel, PDO::PARAM_INT);

                    $statement->execute();

                    $respuesta = $statement->fetch(PDO::FETCH_OBJ);

                    if ($statement->rowCount() > 0) {
                        echo 1;
                    }
                }
                $estado = 0;
                //guardar excel
                $archivo = fopen($_FILES['dataCliente']['tmp_name'], "r");

                //contador para omitir el encabezado
                $i = 0;
                // itera sobre los datos del archivo de Excel y los guarda en la base de datos
                while (($datos = fgetcsv($archivo, 1000, ",")) !== FALSE) {
                    if ($i > 0) {
                        // $nombre = nl2br($datos[4]);
                        $nombre = $datos[0];
                        $correo = $datos[1];
                        $asunto = $datos[2];
                        $saludo = $datos[3];
                        $cuerpo = $datos[4];

                        $correo = quitar_acentos($correo); // Remover acentos
                        $correo = strtolower($correo); // Convertir todo a minúsculas

                        $sql2 = "INSERT INTO CORREOS(NOMBRE,CORREO,ASUNTO,SALUDO,CUERPO) 
                        VALUES(:NOMBRE, :CORREO, :ASUNTO, :SALUDO, :CUERPO);";


                        $statement2 = $conexion->prepare($sql2);
                        $statement2->bindParam(':NOMBRE', $nombre, PDO::PARAM_STR);
                        $statement2->bindParam(':CORREO', $correo, PDO::PARAM_STR);
                        $statement2->bindParam(':ASUNTO', $asunto, PDO::PARAM_STR);
                        $statement2->bindParam(':SALUDO', $saludo, PDO::PARAM_STR);
                        $statement2->bindParam(':CUERPO', $cuerpo, PDO::PARAM_STR);

                        $statement2->execute();
                        $r = $statement2->fetch(PDO::FETCH_OBJ);
                        $statement->closeCursor();

                        if ($statement2->rowCount() > 0) {
                            $correoId = $conexion->lastInsertId();

                            $sql2 = "INSERT INTO USUARIOSCORREOS(NGEID,USUARIOID, CORREOID)
                            VALUES(:NGEID, :USUARIOID, :CORREOID);";


                            $statement2 = $conexion->prepare($sql2);
                            $statement2->bindParam(':USUARIOID', $usuarioId, PDO::PARAM_INT);
                            $statement2->bindParam(':NGEID', $idNombreExcel, PDO::PARAM_INT);
                            $statement2->bindParam(':CORREOID', $correoId, PDO::PARAM_INT);
                            $statement2->execute();
                            $r = $statement2->fetch(PDO::FETCH_OBJ);
                            $statement->closeCursor();

                            if ($statement2->rowCount() > 0) {
                                echo 1;
                            }
                        } else {
                            // cambiar por $estado
                            echo "Ocurrió un error al cargar los datos, intente de nuevo ";
                        }
                    }

                    $i++;
                }

                //cierro el archivo excel
                fclose($archivo);

                echo $estado;
            } else {
                echo "Ha ocurrido un error al guardar la imagen, trate de nuevo!";
            }
        } else {
            echo "El archivo seleccionado no es una imagen valida";
        }
    } else {
        // echo "No Llegue";
        // return;
        echo "Ya existe una campaña con ese nombre, no se permiten registros duplicados";
    }
} else {
    echo "El archivo seleccionado no es .csv";
}