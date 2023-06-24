<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

class Controller
{

    //-------------------------------------------------------------------------------------------------------------------//
    private function ConexionDB()
    {
        // $servidor = 'localhost';
        // $user = 'root';
        // $clave = '';

        $servidor = '10.8.8.100';
        $user = 'admin';
        $clave = '0P$$2022contact';
        $db = "EMAILSEND";
        // $db = "EMAILSENDPRUEBAS";

        $conexion = new PDO('mysql:host=' . $servidor . ";dbname=" . $db . ";charset=utf8", $user, $clave);
        if ($conexion) {
            return $conexion;
        } else {
            return null;
        }
    }
    //-------------------------------------------------------------------------------------------------------------------//

    public function validarSolicitudes()
    {
        // $query = "SELECT ID,USUARIOID,NGEID FROM SOLICITUDENVIARCORREOS WHERE ESTADO = 'A'";
        $query = "SELECT SEC.ID, SEC.USUARIOID, SEC.NGEID, SEC.ACTUALIZACION 
                    FROM SOLICITUDENVIARCORREOS SEC 
                    INNER JOIN (
                    SELECT USUARIOID, MIN(ACTUALIZACION) AS PRIMERA_ACTUALIZACION
                    FROM SOLICITUDENVIARCORREOS
                    WHERE ESTADO = 'A'
                    GROUP BY USUARIOID
                    ) IJ ON SEC.USUARIOID = IJ.USUARIOID AND SEC.ACTUALIZACION = IJ.PRIMERA_ACTUALIZACION
                    WHERE SEC.ESTADO = 'A';
        ";

        $Conexion = $this->ConexionDB();
        if ($Conexion) {
            $statement = $Conexion->prepare($query);
            $statement->execute();
            if ($statement->rowCount() > 0) {
                $datos = $statement->fetchAll(PDO::FETCH_OBJ);
                return [1, 'Solicitud pendiente', $datos];
            } else {
                return [0, 'No hay solicitudes pendientes', null];
            }
        } else {
            return [0, "No se puede conectar a la base de datos", null];
        }
    }
    //-------------------------------------------------------------------------------------------------------------------//
    public function getNextMail($UsuarioID, $IdSolicitudEnvios, $GrupoId)
    {
        $query = "SELECT
                    C.CORREOID CorreoID,
                    C.CORREO as CorreoDestino,
                    C.NOMBRE as Nombre,
                    C.ASUNTO as Asunto,
                    C.SALUDO as Saludo,
                    C.CUERPO as Cuerpo,
                    C.CREACION as Creacion,
                    UC.USUARIOID as UsuarioID,
                    U.CORREOENVIO as CorreoEnvio,
                    U.CLAVEENVIO as ClaveCorreo,
                    NGE.IMAGEN AS Imagen
                    FROM CORREOS AS C
                    INNER JOIN USUARIOSCORREOS AS UC ON UC.CORREOID = C.CORREOID
                    INNER JOIN USUARIOS AS U ON UC.USUARIOID = U.USUARIOID
                    INNER JOIN NOMBRESGRUPOSEXCEL AS NGE ON NGE.NGEID = UC.NGEID
                    WHERE C.ESTADO = 'P'
                    AND UC.USUARIOID = ? AND UC.NGEID = ?
                    ORDER BY C.CREACION ASC
                    LIMIT 1
        ";

        $Conexion = $this->ConexionDB();
        if ($Conexion) {
            $statement = $Conexion->prepare($query);
            $statement->bindParam(1, $UsuarioID);
            $statement->bindParam(2, $GrupoId);
            $statement->execute();
            if ($statement->rowCount() > 0) {
                $datos = $statement->fetchAll(PDO::FETCH_OBJ);
                $statement->closeCursor();
                return [1, 'Siguiente correo pendiente', $datos];
            } else {

                $sql = "UPDATE SOLICITUDENVIARCORREOS SET ESTADO = 'E' WHERE ID = :idSolicitudEnvios;";

                $statement = $Conexion->prepare($sql);
                $statement->bindParam(':idSolicitudEnvios', $IdSolicitudEnvios, PDO::PARAM_INT);

                $statement->execute();
                $respuesta = $statement->fetch(PDO::FETCH_OBJ);
                $statement->closeCursor();

                return [0, 'No hay correos pendientes', null];
            }
        } else {
            return [0, "No se puede conectar a la base de datos", null];
        }
        // }
    }
    //-------------------------------------------------------------------------------------------------------------------//


    //-------------------------------------------------------------------------------------------------------------------//
    //Variables requeridas para el arreglo:
    //CorreoEnvio,
    //ClaveCorreo,
    //CorreoDestino,
    //Asunto,
    //NombreDestino,
    //Cuerpo,
    //CorreoID,
    //UsuarioID
    public function SendMail($args)
    {
        // extract($args);

        // var_dump($args);
        // return;

        $arreglo = json_decode($args, true);

        // $correoID = $arreglo[0]['CorreoID']; // "12"

        $CorreoEnvio = $arreglo[0]['CorreoEnvio'];
        $ClaveCorreo = $arreglo[0]['ClaveCorreo'];
        $CorreoDestino =   $arreglo[0]['CorreoDestino'];
        $Asunto =   $arreglo[0]['Asunto'];
        $Nombre =   $arreglo[0]['Nombre'];
        $Saludo = $arreglo[0]['Saludo'];
        $Cuerpo =   $arreglo[0]['Cuerpo'];
        $CorreoID =   $arreglo[0]['CorreoID'];
        $UsuarioID =   $arreglo[0]['UsuarioID'];
        $Imagen = $arreglo[0]['Imagen'];


        // $CorreoEnvio = $Datos->CorreoEnvio;
        // $ClaveCorreo = $Datos->ClaveCorreo;
        // $CorreoDestino =  $Datos->CorreoDestino;
        // $Asunto =  $Datos->Asunto;
        // $Nombre =  $Datos->Nombre;
        // $Cuerpo =  $Datos->Cuerpo;
        // $CorreoID =  $Datos->CorreoID;
        // $UsuarioID =  $Datos->UsuarioID;

        // echo $UsuarioID;
        // return;
        if ($CorreoEnvio !== null || $ClaveCorreo !== null || $CorreoDestino !== null || $Asunto !== null || $Nombre !== null || $Cuerpo !== null || $CorreoID !== null || $UsuarioID !== null) {

            try {
                //code...

                //detecto los saltos de linea del cuerpo y los convierto a br

                $Cuerpo = nl2br($Cuerpo);
                //Instancia de PHPMailer
                $mail = new PHPMailer(true);
                $ClaveCorreoDec = $this->decrypt($ClaveCorreo);

                $mail->isSMTP();
                $mail->CharSet    = "UTF-8";                                  // Send using SMTP
                $mail->Host       = 'smtp.office365.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = $CorreoEnvio;                     // SMTP username
                $mail->Password   = $ClaveCorreoDec;                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;
                $mail->setFrom($CorreoEnvio);
                $mail->WordWrap   = 50;

                $contenidoHTML = "<head>";
                $contenidoHTML .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
                $contenidoHTML .= "</head><body>";
                $contenidoHTML .= "<b>" . $Saludo . "</b>";
                $contenidoHTML .= "<br /><br />" . $Cuerpo;
                // $contenidoHTML .= "<br /><br /><br /><br /><img src='cid:imagen' width='600px'>";
                $contenidoHTML .= "<br /><br /><br /><br /><img src='cid:imagen' width='600px'>";
                $contenidoHTML .= "</body>\n";


                // echo ($contenidoHTML);
                // return;

                // $mail->AddEmbeddedImage('../imagenes/' . $UsuarioID . '/imagen.png', 'imagen');
                $str = strval($Imagen);
                $rutaImg = "." . $str;

                $mail->AddEmbeddedImage($rutaImg, 'imagen');
                $contenidoTexto = "" . $Cuerpo . "";

                $mail->AltBody = $contenidoTexto; //Text Body
                $mail->MsgHTML($contenidoHTML); //Text body HTML

                $mail->Subject = $Asunto;
                $mail->ClearAllRecipients();
                $mail->AddAddress($CorreoDestino, $Asunto);

                $mail->Send();
                $this->UpdateMailStatus($CorreoID, 'E');
                return [1, "Mensaje enviado con exito", null];
                
                // if ($mail->Send()) {
                //     $this->UpdateMailStatus($CorreoID);
                //     return [1, "Mensaje enviado con exito", null];
                // } else {
                //     return [0, "No se puede enviar el correo", null];
                // }
            } catch (Exception $e) {
                // return [0, "No se puede enviar el correo" . $e->getMessage(), null];
                echo 'Error al enviar el correo electrónico: ' . $e->getMessage(); // puedo e->getMessage()nviar como parametro $e->getMessage() para capturar el error en un tabla
                $this->UpdateMailStatus($CorreoID, 'N');
            }
        } else {
            return [0, "Los datos obtenidos no tienen la estructura correcta", null];
        }
    }
    //-------------------------------------------------------------------------------------------------------------------//

    //-------------------------------------------------------------------------------------------------------------------//
    public function UpdateMailStatus($MailID,$estado)
    {
        $query = "UPDATE CORREOS SET ESTADO = ?, ACTUALIZACION = NOW() WHERE CORREOID = ?";
        $Conexion = $this->ConexionDB();
        if ($Conexion) {
            $statement = $Conexion->prepare($query);
            $statement->bindParam(1, $estado);
            $statement->bindParam(2, $MailID);
            if ($statement->execute()) {
                return [1, 'Correo se actualizo correctamente', null];
            } else {
                return [0, 'No se pudo actualizar el correo', null];
            }
        } else {
            return [0, "No se puede conectar a la base de datos", null];
        }
    }
    //-------------------------------------------------------------------------------------------------------------------//

    //-------------------------------------------------------------------------------------------------------------------//
    public function decrypt($hash)
    {

        $clave = "op$2o23";
        $result = '';
        $hash = base64_decode($hash);
        for ($i = 0; $i < strlen($hash); $i++) {
            $char = substr($hash, $i, 1);
            $keychar = substr($clave, ($i % strlen($clave)) - 1, 1);
            $char = chr(ord($char) - ord($keychar));
            $result .= $char;
        }
        return $result;
    }
    //-------------------------------------------------------------------------------------------------------------------//

}
