<?php 
// listo
if (!isset($_SESSION)) {
    session_start();
}
include_once './conexion.php';

$NGEID = $_POST["NGEID"];
$usuarioId = $_SESSION['campoId'];

//valido si se esta enviando los correos y si es asi, detengo el envio
$sql = "UPDATE SOLICITUDENVIARCORREOS SET ESTADO = 'I', ACTUALIZACION = NOW() WHERE NGEID = :NGEID AND USUARIOID = :usuarioId AND ESTADO = 'A';";

$statement = $conexion->prepare($sql);
$statement->bindParam(':NGEID', $NGEID, PDO::PARAM_INT);
$statement->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);

$statement->execute();
$respuesta = $statement->fetch(PDO::FETCH_OBJ);
$statement->closeCursor();

if ($statement->rowCount() > 0) {
    echo "Envio Cancelado";
}else{
    echo "Aun no se estan enviado los correos de esta campaña";
}
?>