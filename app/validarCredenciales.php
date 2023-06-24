<?php
include("./conexion.php"); //$conexion

// require 'funcionesEnviarCorreo.php';
if (!isset($_SESSION)) {
    session_start();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';


if (isset($_POST['cuentaCorreo']) && !empty($_POST['cuentaCorreo']) && isset($_POST['cuentaClave']) && !empty($_POST['cuentaClave'])) {
    //correo de prueba 

    if (isset($_SESSION['campoId'])) {
        $usuarioid = $_SESSION['campoId'];
    }else{
        $usuarioid = 0;
    }
   


    $correo = $_POST['cuentaCorreo'];
    $correo = strtolower($correo);
    $clave = $_POST['cuentaClave'];

    $sql = 'SELECT USUARIOID,CORREOENVIO FROM USUARIOS WHERE CORREOENVIO = :correo';
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':correo', $correo, PDO::PARAM_STR);
    $statement->execute();
    $resultado = $statement->fetch(PDO::FETCH_ASSOC);

    if ($statement->rowCount() > 0 && $resultado['USUARIOID'] != $usuarioid) {
        echo 'Ya existe el correo '.$correo.', no se permiten registros duplicados';
    } elseif (($statement->rowCount() > 0 && $resultado['USUARIOID'] == $usuarioid) ||
        ($statement->rowCount() <= 0)
    ) {
        
        // if (!$resultado) {
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                $mail = new PHPMailer(true);
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();

                $mail->CharSet    = "UTF-8";                                  // Send using SMTP
                $mail->Host       = 'smtp.office365.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = $correo;                     // SMTP username
                $mail->Password   = $clave;                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom($correo, 'Validacion de credenciales');
                //Set an alternative reply-to address
                // $mail->addReplyTo('replyto@example.com', 'First Last');
                //Set who the message is to be sent to
                $mail->addAddress($correo, 'Validacion de credenciales');
                //Set the subject line
                $mail->Subject = 'Validacion de credenciales';

                $mail->IsHTML(true);
                //Read an HTML message body from an external file, convert referenced images to embedded,
                //convert HTML into a basic plain-text alternative body
                $mail->msgHTML("Validación de credenciales <br><br> Las credenciales son válidas.");
                // $mail->AddEmbeddedImage( '../imagenes/img.jpg');
                //Replace the plain text body with one created manually
                $mail->AltBody = "Validación de credenciales <br><br> Las credenciales son válidas.";
                //Attach an image file
                // $mail->addAttachment('images/phpmailer_mini.png');
                // $mail->AddEmbeddedImage('localhost/enviarCorreo/imagenes/img.jpg', 'jpg', 'img.jpg');

                //send the message, check for errors
                if (!$mail->send()) {
                    $_SESSION['credencialesV'] = false;
                    echo 'Ocurrió un problema al enviar el correo de validación: ' . $mail->ErrorInfo;
                } else {

                    $_SESSION['credencialesV'] = true;
                    echo 1;
                }
            } catch (Exception $e) {
                $_SESSION['credencialesV'] = false;
                echo 'Ocurrió un problema al enviar el correo de validación, por favor revise las credenciales: '.$mail->ErrorInfo;
            }
        // } else {
        //     echo "Ya existe el correo: " . $correo . ", no se permiten registros duplicados";
        // }
    }
} else {
    $_SESSION['credencialesV'] = false;
    echo "Ingrese las credenciales para él envió de correos";
}
