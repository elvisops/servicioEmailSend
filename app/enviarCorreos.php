<?php
// listo
if (!isset($_SESSION)) {
    session_start();
}

include_once './conexion.php';

$nombreGrupoId = $_POST['grupoId'];
$usuarioId = $_SESSION['campoId'];


//si no ay imagen informo al usuario ya que los correos no se van a enviar sin la imagen
$sql = "SELECT IMAGEN FROM NOMBRESGRUPOSEXCEL WHERE NGEID = :nombreGrupoId AND USUARIOID = :usuarioId";

$statement = $conexion->prepare($sql);
$statement->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
$statement->bindParam(':nombreGrupoId', $nombreGrupoId, PDO::PARAM_INT);
$statement->execute();
$respuesta = $statement->fetch(PDO::FETCH_OBJ);
$statement->closeCursor();

$mensaje = "Por favor seleccione la imagen que se enviara con los correos";
if ($statement->rowCount() > 0) {
    $path = $respuesta->IMAGEN;

    if($path == "" || !isset($path)){
        echo $mensaje;
        return;
    }
    $str = strval($path);
    $ruta = ".".$str;
    if (!file_exists($ruta)) {
        echo $mensaje;
        return;
    }
}else{
    echo $mensaje;
    return;
}


// // $path = __FILE__.'/../imagenes/'.$usuarioId.'/imagen.png';
// $path = '../imagenes/' . $usuarioId . '/imagen.png';

// if (!file_exists($path)) {
//     echo "Por favor seleccione la imagen que se enviara con los correos";
//     return;
// }

//valido si la campaña ya estan enviandose los correos se puede quitar ya que se desabilito el boton
// $sql = "SELECT ID,NGEID FROM SOLICITUDENVIARCORREOS WHERE ESTADO = 'A' AND USUARIOID = :usuarioId AND NGEID = :nombreGrupoId";

// $statement = $conexion->prepare($sql);
// $statement->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
// $statement->bindParam(':nombreGrupoId', $nombreGrupoId, PDO::PARAM_INT);
// $statement->execute();
// $respuesta = $statement->fetch(PDO::FETCH_OBJ);
// $statement->closeCursor();

// if ($statement->rowCount() > 0) {
//     echo "Se estan enviando los correos de esta campaña";
//     return;
// }

//valido si se esta enviando una campaña
$sql = "SELECT ID,NGEID FROM SOLICITUDENVIARCORREOS WHERE ESTADO = 'A' AND USUARIOID = :usuarioId";

$statement = $conexion->prepare($sql);
$statement->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
$statement->execute();
$respuesta = $statement->fetch(PDO::FETCH_OBJ);
$statement->closeCursor();

if ($statement->rowCount() > 0) {
    // //Obtengo el id de la campaña que se esta enviado
    // $campañaEnviandose = $respuesta->NGEID;
    // //Traigo el nombre de la campaña que se esta enviando
    // $sql = "SELECT NOMBRES FROM NOMBRESGRUPOSEXCEL WHERE NGEID = :nombreGrupoId;";

    // $statement = $conexion->prepare($sql);
    // $statement->bindParam(':nombreGrupoId', $campañaEnviandose, PDO::PARAM_INT);
    // $statement->execute();
    // $respuesta = $statement->fetch(PDO::FETCH_OBJ);
    // $statement->closeCursor();

    // // if($statement->rowCount() > 0){
    // //     $nombreCampaña = $respuesta->NOMBRES;
    // //     echo "Se estan enviando los correos de la campaña: " . $nombreCampaña;
    // //     return;
    // // }
    // if ($statement->rowCount() > 0) {
       
        $sql = "UPDATE SOLICITUDENVIARCORREOS SET ESTADO = 'A', ACTUALIZACION = NOW() WHERE NGEID = :nombreGrupoId AND USUARIOID = :usuarioId;";

        $statement = $conexion->prepare($sql);
        $statement->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
        $statement->bindParam(':nombreGrupoId', $nombreGrupoId, PDO::PARAM_INT);
    
        $statement->execute();
    
        $respuesta = $statement->fetch(PDO::FETCH_OBJ);
    
        if ($statement->rowCount() > 0) {
            $_SESSION['grupoId'] = $nombreGrupoId;
            // echo "Se enviaran los correos de la campaña una ves se concluya con los correos pendientes";
            echo "El envio de correos de la campaña esta en cola ya que se estan enviado los correos de otra campaña";
            return;
        }
        
        
        
        // $sql = "UPDATE SOLICITUDENVIARCORREOS SET ESTADO = 'A', ACTUALIZACION = NOW() WHERE NGEID = :nombreGrupoId AND USUARIOID = :usuarioId;";

        // $statement = $conexion->prepare($sql);
        // $statement->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
        // $statement->bindParam(':nombreGrupoId', $nombreGrupoId, PDO::PARAM_INT);

        // $statement->execute();

        // $respuesta = $statement->fetch(PDO::FETCH_OBJ);

        // if ($statement->rowCount() > 0) {
        //     $_SESSION['grupoId'] = $nombreGrupoId;
        //     echo "Enviando correos!";
        // }
    // }
} 
    //si no se esta enviando ninguna campaña puedo actualizar el estado a Activo
    //Actualizo el estado "A" de activo para que el cron empiese a enviar correos
    $sql = "UPDATE SOLICITUDENVIARCORREOS SET ESTADO = 'A', ACTUALIZACION = NOW() WHERE NGEID = :nombreGrupoId AND USUARIOID = :usuarioId;";

    $statement = $conexion->prepare($sql);
    $statement->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
    $statement->bindParam(':nombreGrupoId', $nombreGrupoId, PDO::PARAM_INT);

    $statement->execute();

    $respuesta = $statement->fetch(PDO::FETCH_OBJ);

    if ($statement->rowCount() > 0) {
        $_SESSION['grupoId'] = $nombreGrupoId;
        echo "Enviando correos!";
    }


