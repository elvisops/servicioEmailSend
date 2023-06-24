<?php 
include './conexion.php';
if (!isset($_SESSION)) {
    session_start();
}

$GrupoId = $_POST["NGEID"];

//Actualizo el estado "I" de inactivo 
$sql = "UPDATE NOMBRESGRUPOSEXCEL SET ESTADO = 'I' WHERE NGEID = :NGEID;";

$statement = $conexion->prepare($sql);
$statement->bindParam(':NGEID', $GrupoId, PDO::PARAM_INT);

$statement->execute();

$respuesta = $statement->fetch(PDO::FETCH_OBJ);

if ($statement->rowCount() > 0) {
    echo 1;
}else{
    echo "Ocurrio un error al eliminar la campañar";
}
?>