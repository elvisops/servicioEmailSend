<?php

include './conexion.php';
if (!isset($_SESSION)) {
    session_start();
}
$usuarioId = $_SESSION["campoId"];
$GrupoId = $_SESSION["grupoId"];

$sql = "UPDATE SOLICITUDENVIARCORREOS SET ESTADO = 'X', ACTUALIZACION = NOW() WHERE USUARIOID = :usuarioId AND NGEID = :GrupoId ;";
$statement = $conexion->prepare($sql);
$statement->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
$statement->bindParam(':GrupoId', $GrupoId, PDO::PARAM_INT);
$statement->execute();
$idcorreo = $statement->fetch(PDO::FETCH_OBJ);
$statement->closeCursor();

// echo json_encode($idcorreo);
if ($statement->rowCount() > 0) {
    echo 1;
} else {

    echo 0;
}
