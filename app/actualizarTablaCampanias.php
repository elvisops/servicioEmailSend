<?php
include './conexion.php';
if (!isset($_SESSION)) {
    session_start();
}
$usuarioId = $_SESSION["campoId"];
// $GrupoId = $_SESSION["grupoId"];

$query = "SELECT NG.NGEID AS NGEID, NG.NOMBRES AS NOMBRE, 
NG.USUARIOID AS USUARIOID, SC.ESTADO AS ESTADO, NG.ESTADO AS ESTADOCAMPAÑA 
FROM NOMBRESGRUPOSEXCEL NG
INNER JOIN SOLICITUDENVIARCORREOS SC
ON NG.NGEID = SC.NGEID
WHERE NG.USUARIOID = :usuarioId;";
$stmt = $conexion->prepare($query);
$stmt->bindParam(":usuarioId", $usuarioId, PDO::PARAM_INT);
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
$stmt->closeCursor();
if ($stmt->rowCount() > 0) {
    echo json_encode($resultado);
} else {
    echo 0;
}
?>