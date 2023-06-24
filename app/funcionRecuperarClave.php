<?php
include "./conexion.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

if(!isset($_POST['mail']) || $_POST['mail'] != ""){
    $correoLogin = $_POST['mail'];
    $correoLogin = strtolower($correoLogin);
    $sql = 'SELECT USUARIOID,CORREOLOGIN FROM USUARIOS WHERE CORREOLOGIN = :correoLogin';
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':correoLogin', $correoLogin, PDO::PARAM_STR);
    $statement->execute();
    $correo = $statement->fetch(PDO::FETCH_ASSOC);

    
    if ($statement->rowCount() > 0) {
        $url = "http://".$_SERVER["SERVER_NAME"]."/Emailsend/cambiarClave.php?id=".$correo['USUARIOID'];
        $urlImg = "http://".$_SERVER["SERVER_NAME"]."/Emailsend/imagenes/ops.png";
        // echo $url;
        try {
            $mail = new PHPMailer(true);
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();

            $mail->CharSet    = "UTF-8";                                  // Send using SMTP
            $mail->Host       = 'smtp.office365.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'notificaciones@ops.com.hn';                     // SMTP username
            $mail->Password   = 'Gay59797';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('notificaciones@ops.com.hn', 'Recuperación de contraseña');

            $mail->addAddress($correoLogin, 'Recuperación de contraseña');
            //Set the subject line
            $mail->Subject = 'Recuperación de contraseña';

            $mail->IsHTML(true);
            //Read an HTML message body from an external file, convert referenced images to embedded,

            //Replace the plain text body with one created manually
            $mail->Body = "<body>
                    <h2>Se ha solicitado un reinició de contraseña para el correo: {$correoLogin}</h2>
                    <h3>Para restaurar la contraseña ingrese en el siguiente enlace <a href='{$url}'>Restaurar contraseña</a></h3>
                    <br /><br />
                </body>";
                // <img src='cid:ops' width='600px'>
                

            if (!$mail->send()) {
                $_SESSION['credencialesV'] = false;
                echo 'Ocurrió un problema al enviar el correo de validación: ' . $mail->ErrorInfo;
            } else {
                $usuarioId = $correo['USUARIOID'];
                $correoLogin = strtolower($correoLogin);
                $sql = 'UPDATE USUARIOS SET RESETCLAVE= "1" WHERE USUARIOID = :usuarioId';
                $statement = $conexion->prepare($sql);
                $statement->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
                $statement->execute();
                $resultado = $statement->fetch(PDO::FETCH_ASSOC);
                $_SESSION['credencialesV'] = true;
                echo 1;
            }
        } catch (Exception $e) {
            $_SESSION['credencialesV'] = false;
            echo 'Ocurrió un problema al enviar el correo para el cambio de contraseña: '.$mail->ErrorInfo;
        }
    }else{
        echo "Por favor ingrese un correo electrónico valido";
    }
}else{
    echo "Por favor ingrese su correo electrónico";
}
