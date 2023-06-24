<?php
$servidor = "localhost";
$usuario = "admin";
$password = "0P$$2022contact";
$db = "EMAILSEND";
// $db = "EMAILSENDPRUEBAS";

// $servidor = "localhost";
// $usuario = "root";
// $password = "";
// $db = "EMAILSEND";

try {
  $conexion = new PDO("mysql:host=$servidor;dbname=$db;charset=utf8", $usuario, $password);
  // $conexion->exec("SET NAMES 'utf8'");
  $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conexion->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
  return $conexion;
  echo "Conexión realizada Satisfactoriamente";
} catch (PDOException $e) {
  echo "La conexión ha fallado: " . $e->getMessage();
}

$conexion = null;
