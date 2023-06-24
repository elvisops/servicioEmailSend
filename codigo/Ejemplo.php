<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require '../phpmailer2/src/Exception.php';
require '../phpmailer2/src/PHPMailer.php';
require '../phpmailer2/src/SMTP.php';

session_start();
include "../Back/Controlador.php"; 
$conn = new Controller();

$resultado=$conn->Mantenimientos('ListarMarcaje','');
$data=$resultado[2];
if (count($data)>0) {

	

	try {
		$mail = new PHPMailer(true);
                            //Server settings
                            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
		$mail->isSMTP();
		$mail->CharSet = 'UTF-8';     

                            $mail->charSet    = "UTF-8";                                  // Send using SMTP
                            $mail->Host       = 'smtp.office365.com';                    // Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                            $mail->Username   = 'notificaciones@ops.com.hn';                     // SMTP username
                            $mail->Password   = 'Gay59797';                               // SMTP password
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                            //Recipients
                            $mail->setFrom('notificaciones@ops.com.hn');

                            $mail->addBCC('carlos.miranda@ops.com.hn');
                            $mail->addAddress('yasmin.villanueva@ops.com.hn');
                            $mail->addAddress('valeria.argueta@ops.com.hn');
                            $mail->addAddress('damaris.mejia@ops.com.hn');
                            $mail->AddCC('cristina.almendares@ops.com.hn');
                            
                                // Add a recipient
                            

                            $Body=' 
                            <html>
                            <head>
                            <meta name="viewport" content="width=device-width" />
                            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                            <title></title>
                            	<style>
                            	body{
                            		color:white;
                            	}
                            	img{
                            		text-align:center;
                            	}
                            	.main {
				                   background: #12293F;
				                   border-radius: 3px;
				                   width: 90%; 
				                   margin-left:auto;
				                   margin-right:auto;

				               }

				               .wrapper {
				                   box-sizing: border-box;
				                   padding: 20px; 
				               }

				               .footer ,
					               .footer p,
					               .footer span,
					               .footer a {
					                 color: #ffffff;
					                 font-size: 12px;
					                 text-align: center; 
					             }
					             table{
					             	width: 100%;
    								margin-bottom: 1rem;
					             }

					             tr, td{
					             	color: #ffffff;
					                 font-size: 12px;
					                 text-align: center; 
					             } 
					             h3 a{
					             	color: #ffffff;
					             }

                            	</style>                                    
                            		</head>
                            		<body class="">                                               
                            		<div class="main">

                            		<!-- START CENTERED WHITE CONTAINER -->
                            		<center>
                            		
                            		<hr>
                            		</center>
                            		<h1 style="color:white; text-align:center;">
                            		 OPS Contact Center
                            		</h1>
                            		

                            		

                            		<h3 style="text-align:center;">Persona con 2 dias sin marcar o mas a fecha: '.date('d/m/Y').'</h3>
                            		<div style="background-color:#12293F;">
                            		<table style="border: 1px solid white; background-color:#12293F;">
	                            		<thead>
			                            	<tr style="border: 1px solid white;">
			                            		<th style="border: 1px solid white;">Identidad</th>
			                            		<th style="border: 1px solid white;">Nombre</th>
			                            		<th style="border: 1px solid white;">Dias sin marcar</th>
			                            		<th style="border: 1px solid white;">Fecha Ultima Asistencia</th>
			                            		<th style="border: 1px solid white;">Área</th>
			                            		<th style="border: 1px solid white;">Supervisor</th>
		                            		</tr>
	                            		</thead>
	                            		<tbody style="">';



                            		for ($i=0; $i < count($data) ; $i++) { 

                            			$Body.='<tr>
			                            			<td style="border: 1px solid white;">'.$data[$i]['Identidad'].'</td>
			                            			<td style="border: 1px solid white;" nowrap>'.$data[$i]['nombre'].'</td>
			                            			<td style="border: 1px solid white;">'.$data[$i]['dias'].'</td>
			                            			<td style="border: 1px solid white;">'.date("d/m/Y H:i:s",strtotime($data[$i]['ult_asistencia'])).'</td>
			                            			<td style="border: 1px solid white;">'.$data[$i]['Area'].'</td>
			                            			<td style="border: 1px solid white;" nowrap>'.$data[$i]['Supervisor'].'</td>
		                            			</tr>';


                            		}

                            		$Body.='</tbody>
                            		</table>
                            		</div>
                            			<h3 style="text-align:center;">Para mas informacion, favor ingrese a <a href="http://10.8.8.100/Marcador">Sistema de Marcador</a></h3>
                            		
                            		
                            		<!-- START FOOTER -->
                            		<div class="footer">
                            		
	                            		<span class="apple-link">OPS Contact Center, Blv. suyapa edificio C.H. Inversiones 6to nivel.</span>

	                            		Website: <a href=https://ops.com.hn/es target="_blank">ops.com.hn</a>.
                            		
                            		</div>
                            		<!-- END FOOTER -->

                            		</div>
                            	
                            		</body>
                            		</html>
                            		';

                            // Content
                            $mail->isHTML(true);                                  // Set email format to HTML
                            $mail->Subject = "PERSONAL SIN MARCACION MAYOR A 3 DIAS | MARCACIÓN OPS";
                            $mail->Body    = $Body;
                          $mail->send();
                            echo $Body;
                            echo "Se envio correctamente";
                        } catch (Exception $e) {
                        	echo "eror al enviar el correo";
                        }
                        ?>






                        <?php
                    }
                ?>