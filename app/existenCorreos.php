<?php
include './conexion.php';
if (!isset($_SESSION)) {
    session_start();
}
if (!(isset($_SESSION["grupoId"])) || $_SESSION["grupoId"] == "" ) {
    $_SESSION["grupoId"] = 0;
    $GrupoId = $_SESSION["grupoId"];
}

$usuarioId = $_SESSION["campoId"];
$GrupoId = $_SESSION["grupoId"];

$sql = "SELECT * FROM SOLICITUDENVIARCORREOS WHERE ESTADO = 'E' AND USUARIOID = :usuarioId AND NGEID = :GrupoId;";
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
