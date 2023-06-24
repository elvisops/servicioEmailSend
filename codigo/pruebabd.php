<?php

$publisher_id = 1;

// connect to the database and select the publisher
$pdo = require 'Conexion.php';

$sql = 'SELECT *
		FROM CORREO
        WHERE IDCORREO = :publisher_id';

$statement = $pdo->prepare($sql);
$statement->bindParam(':publisher_id', $publisher_id, PDO::PARAM_INT);
$statement->execute();
$publisher = $statement->fetch(PDO::FETCH_ASSOC);

if ($publisher) {
	// echo $publisher['IDCORREO'] . '.' . $publisher['NOMBRE'];
    // $mailTo=array(
        
    //     // $fila->correo => $fila->nombre
        
    //     "elvis.godoy@ops.com.hn"=>"Elvis Godoy"
    //     #"xaviergodoyortega@gmail.com"=>"Xavier Ortega"
    // );
    print_r($publisher);
} else {
	echo "The publisher with id $publisher_id was not found.";
}