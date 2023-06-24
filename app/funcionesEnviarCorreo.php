<?php
// realizar pruebas en el servidor para borrar las lineas comentadas

include './conexion.php';
if (!isset($_SESSION)) {
    session_start();
}
$usuarioId = $_SESSION["campoId"];
$nombreGrupoId = $_POST['grupoId'];

// existenCorreos($nombreGrupoId);

// function existenCorreos($nombreGrupoId)
// {
    // include './conexion.php';
    
    $id =  $_SESSION['campoId'];

    $sql = "SELECT C.CORREOID AS CORREOID,C.NOMBRE AS NOMBRE,
    C.CORREO AS CORREO,C.ASUNTO AS ASUNTO,C.CUERPO AS CUERPO,C.ESTADO AS ESTADO FROM USUARIOS U
    INNER JOIN USUARIOSCORREOS UC
    ON U.USUARIOID = UC.USUARIOID
    INNER JOIN CORREOS C
    ON UC.CORREOID = C.CORREOID
    WHERE C.ESTADO = 'P' AND UC.USUARIOID = :id AND UC.NGEID = :nombreGrupoId LIMIT 1;    
    ";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':nombreGrupoId', $nombreGrupoId, PDO::PARAM_INT);
    $statement->execute();
    $idcorreo = $statement->fetch(PDO::FETCH_OBJ);
    
       if($statement->rowCount() > 0){
        $_SESSION['grupoId'] = $nombreGrupoId;
        echo 1;
    }else{
        echo 0;
    }

// }

// function traerCorreos($nombreGrupoId)
// {
//     include './conexion.php';
    
//     $id =  $_SESSION['campoId'];

//     // $statement = $conexion->prepare('SELECT CORREOID,NOMBRE,CORREO,ASUNTO,CUERPO,ESTADO 
//     // FROM CORREOS WHERE ESTADO = "P" AND USUARIOID = :id LIMIT 1;');

//     $sql = "SELECT C.CORREOID AS CORREOID,C.NOMBRE AS NOMBRE,
//     C.CORREO AS CORREO,C.ASUNTO AS ASUNTO,C.CUERPO AS CUERPO,C.ESTADO AS ESTADO FROM USUARIOS U
//     INNER JOIN USUARIOSCORREOS UC
//     ON U.USUARIOID = UC.USUARIOID
//     INNER JOIN CORREOS C
//     ON UC.CORREOID = C.CORREOID
//     WHERE C.ESTADO = 'P' AND UC.USUARIOID = :id AND UC.NGEID = :nombreGrupoId LIMIT 1;    
//     ";
//     $statement = $conexion->prepare($sql);
//     $statement->bindParam(':id', $id, PDO::PARAM_INT);
//     $statement->bindParam(':nombreGrupoId', $nombreGrupoId, PDO::PARAM_INT);
//     $statement->execute();
//     $idcorreo = $statement->fetch(PDO::FETCH_OBJ);
    
    
//     return $idcorreo;

// }

// function actualizarEstadoCorreo($correoid)
// {
//     include './conexion.php';
//     date_default_timezone_set('America/Tegucigalpa');
//     $actualizacion= date("Y-m-d h:i:s");

//     $sql = 'UPDATE CORREOS SET ESTADO="E",ACTUALIZACION = :actualizacion WHERE CORREOID = :correoid;';

//     $statement = $conexion->prepare($sql);
//     $statement->bindParam(':correoid', $correoid, PDO::PARAM_INT);
//     $statement->bindParam(':actualizacion', $actualizacion, PDO::PARAM_STR);

//     $statement->execute();
//     $resultado = $statement->fetch(PDO::FETCH_OBJ);

//     if($statement->rowCount() > 0){
//         echo 1;
//     }else{
//         echo 0;
//     }

// }
?>