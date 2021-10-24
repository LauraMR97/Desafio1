<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recupera tu cuenta</title>
    <link rel="stylesheet" type="text/css" href="./CSS/general.css">
</head>

<body class="oriental">
<?php
        session_start();
        //Instalamos con: sudo apt-get install libphp-phpmailer. Se podría hacer con sendmail pero es más rollo.
//        require_once 'phpmailer/src/PHPMailer.php';
//        require_once 'phpmailer/src/SMTP.php';
//        require_once 'phpmailer/src/Exception.php';
//        
//        require_once '/usr/share/php/libphp-phpmailer/src/PHPMailer.php';
//        require_once '/usr/share/php/libphp-phpmailer/src/SMTP.php';
//        require_once '/usr/share/php/libphp-phpmailer/src/Exception.php';
//        require_once '/usr/share/php/libphp-phpmailer/autoload.php';
//        use PHPMailer\PHPMailer\PHPMailer;
//        use PHPMailer\PHPMailer\Exception;
//        require_once 'PHPMailer/src/PHPMailer.php';
//        require_once 'PHPMailer/src/SMTP.php';
//        require_once '/usr/share/php/libphp-phpmailer/src/SMTP.php';
//        
//        
//        $email_user = "AuxiliarDAW2@gmail.com";
//        $email_password = "Chubaca20";
//        $the_subject = "Phpmailer prueba";
//        $address_to = "faranzabe@gmail.com";
//        $from_name = "Fernando Aranzabe";
//        $phpmailer = new PHPMailer(true);
//        // ---------- datos de la cuenta de Gmail -------------------------------
//        $phpmailer->Username = $email_user;
//        $phpmailer->Password = $email_password;
//        //-----------------------------------------------------------------------
//        // $phpmailer->SMTPDebug = 1;
//        $phpmailer->SMTPSecure = 'ssl'; //Puede ser TSL pero el puerto sería 587.
//        $phpmailer->Host = "smtp.gmail.com"; // GMail
//        $phpmailer->Port = 465;
//        $phpmailer->IsSMTP(); // use SMTP
//        $phpmailer->SMTPAuth = true;
//        $phpmailer->setFrom($phpmailer->Username, $from_name);
//        $phpmailer->AddAddress($address_to); // recipients email
//        $phpmailer->Subject = $the_subject;
//        $phpmailer->Body .= "<h1 style='color:#3498db;'>Un dos, si, hey, si, un dos!!!!</h1>";
//        $phpmailer->Body .= "<p>Mensaje personalizado</p>";
//        $phpmailer->Body .= "<p>Fecha y Hora: " . date("d-m-Y h:i:s") . "</p>";
//        $phpmailer->IsHTML(true);
//        if ($phpmailer->send()) {
//            echo 'Correo enviado.';
//        } else {
//            echo 'Se ha producido algún error en el envío.';
//        }

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;

        require_once 'phpmailer/src/Exception.php';
        require_once 'phpmailer/src/PHPMailer.php';
        require_once 'phpmailer/src/SMTP.php';

        $emailDestino = $_SESSION['correoDest'];
        
        $mail = new PHPMailer();
        try {
//            $mail->SMTPDebug = 2;  // Sacar esta línea para no mostrar salida debug
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Host de conexión SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'auxiliardaw2@gmail.com';                 // Usuario SMTP
            $mail->Password = 'Chubaca20';                           // Password SMTP
            $mail->SMTPSecure = 'tls'; 
            //$mail->SMTPSecure = 'ssl';                            // Activar seguridad TLS
            //$mail->Port = 465;                                    // Puerto SMTP
            $mail->Port = 587;                                    // Puerto SMTP
            #$mail->SMTPOptions = ['ssl'=> ['allow_self_signed' => true]];  // Descomentar si el servidor SMTP tiene un certificado autofirmado
            #$mail->SMTPSecure = false;				// Descomentar si se requiere desactivar cifrado (se suele usar en conjunto con la siguiente línea)
            #$mail->SMTPAutoTLS = false;			// Descomentar si se requiere desactivar completamente TLS (sin cifrado)

            $mail->setFrom('AuxiliarDAW2@gmail.com');  // Mail del remitente
            $mail->addAddress($emailDestino);     // Mail del destinatario

            $mail->isHTML(true);
            $mail->Subject = 'Contacto desde formulario';  // Asunto del mensaje
            $contNueva=$_SESSION['newPassword'];
            $mail->Body = 'Esta es tu nueva contraseña: <b>'.$contNueva.'</b>';    // Contenido del mensaje (acepta HTML)
            $mail->AltBody = 'Este es el contenido del mensaje en texto plano';    // Contenido del mensaje alternativo (texto plano)

            $mail->send();
            echo 'El mensaje ha sido enviado';
        } catch (Exception $e) {
            echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
        }


//Lo que viene a continuación sería para windows. Bajando la librería sendmail y configurando php.ini y sendmail.ini en XAMPP.        
//        $desde = "AuxiliarDAW2@gmail.com";
//        $destinatario = 'faranzabe@gmail.com';
//        $titulo = 'Validacion cuenta';
//        $cabeceras = phpversion();
//        //$cabeceras = "From:" . $desde;
//        $mensaje = 'Tu cuenta ha sido validada';
//        //mail($destinatario, $titulo, $mensaje);
//        mail($destinatario, $titulo, $mensaje, $cabeceras);
//        echo "El correo ha sido enviado.";
//
//        $cabeceras = 'From: webmaster@example.com' . "\r\n" .
//                'Reply-To: webmaster@example.com' . "\r\n" .
//                'X-Mailer: PHP/' . phpversion();
//
//        mail($para, $titulo, $mensaje, $cabeceras);
//        $destino = 'faranzabe@gmail.com';
//
//        $titulo = 'Email recibido';
//        $cabeceras = 'From: Equipo' . "\r\n" .
//                'Reply-To: ese' . "\r\n" .
//                'X-Mailer: PHP/' . phpversion();
//
//        $mensaje = "Estamos estudiando su solicitud, recibirá un correo con toda la información necesaria";
//
//        mail($destino, $titulo, $mensaje, $cabeceras);
//        echo "El correo ha sido enviado.";
        ?>
       <main class="container oriental">
        <header class="row oriental">
                <h1>Escape Web</h1>
                <h4>Tu pagina de scape room</h4>
            </div>
        </header>

        <section class="row">

            <div class="xl-col-12 l-col-12 m-col-12 s-col-12 separado">
                <h3>Recupera tu cuenta:</h3>
            </div>
                <div class="row">
                    <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                       <p>Mensaje enviado</p>
                    </div>
                </div>
                <form action="controlador.php" method="POST" class="oriental">
                <div class="row">
                    <div class="margen-4 l-col-2 m-col-2 s-col-2 ">
                        <input type="submit" value="Volver" name="VolverPassword">
                    </div>
                    <div class="l-col-2 m-col-2 s-col-2 ">
                        <input type="submit" value="Volver Login" name="CerrarSesion">
                    </div>
                </div>
            </form>
        </section>
        <footer class=" oriental row">
            <div class="xl-col-12 l-col-12 m-col-12 s-col-12">
                <p>Email: EscapeRoom@juegos.com</p>
            </div>
        </footer>
    </main>
</body>

</html>