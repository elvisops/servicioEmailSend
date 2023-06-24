<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once './conexion.php';

// $nombreGrupoId = $_POST['grupoId'];
$usuarioId = $_SESSION['campoId'];

// echo $usuarioId;

//valido si la campaña ya estan enviandose los correos
$sql = "SELECT ID,NGEID FROM SOLICITUDENVIARCORREOS WHERE ESTADO = 'A' AND USUARIOID = :usuarioId;";

$statement = $conexion->prepare($sql);
$statement->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
// $statement->bindParam(':nombreGrupoId', $nombreGrupoId, PDO::PARAM_INT);
$statement->execute();
$respuesta = $statement->fetch(PDO::FETCH_OBJ);
$statement->closeCursor();

if ($statement->rowCount() > 0) {
    $idCampaña = $respuesta->NGEID;
    echo $idCampaña;
}else{
    echo 0;
}