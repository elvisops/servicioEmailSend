<?php
include './Controller.php';

$serverip = "10.8.8.100"; // Dirección IP del servidor
$clientip = $_SERVER['REMOTE_ADDR']; // Dirección IP del cliente

//Validacion de que el envio sea realizado unicamente por parte del servidor
// if ($clientip == $serverip) {

    $obj = new Controller;
    $fn = $obj->validarSolicitudes();

    if ($fn[0] == 1) {
        $usuarioID = json_encode($fn[2]);

        $datos = json_decode($usuarioID, true);

        // Recorrer el arreglo con el bucle foreach
        foreach ($datos as $fila) {

            $idSolicitudEnvios = $fila['ID'];
            $usuarioID = $fila['USUARIOID'];
            $grupoId = $fila['NGEID'];

            $fn1 = $obj->getNextMail($usuarioID, $idSolicitudEnvios, $grupoId);

            if ($fn1[0] == 1) {

                $MailData = json_encode($fn1[2]);


                $datos = json_decode($MailData, true);
                $fn2 = $obj->SendMail($MailData);
            } else {
                echo json_encode($fn1);
            }
        }
    } else {
        echo json_encode($fn);
    }
// } else {
//     echo "Error no tiene acceso a enviar con esta modalidad";
// }

// // $USUARIOID = $_GET['UsuarioID'];
// $SERVERIP = $_SERVER['REMOTE_ADDR'];


// if ($SERVERIP == "127.0.0.1") {
//     //Validacion de que el envio sea realizado unicamente por parte del servidor
//     $obj = new Controller;
//     $fn = $obj->validarSolicitudes();

//     if ($fn[0] == 1) {
//         $usuarioID = json_encode($fn[2]);

//         $datos = json_decode($usuarioID, true);

//         // Recorrer el arreglo con el bucle foreach
//         foreach ($datos as $fila) {

//             $idSolicitudEnvios = $fila['ID'];
//             $usuarioID = $fila['USUARIOID'];
//             $grupoId = $fila['NGEID'];

//             $fn1 = $obj->getNextMail($usuarioID, $idSolicitudEnvios, $grupoId);

//             if ($fn1[0] == 1) {

//                 $MailData = json_encode($fn1[2]);


//                 $datos = json_decode($MailData, true);
//                 $fn2 = $obj->SendMail($MailData);
//             } else {
//                 echo json_encode($fn1);
//             }
//         }
//     } else {
//         echo json_encode($fn);
//     }
// } else {
//     echo "Error no tiene acceso a enviar con esta modalidad";
// }
