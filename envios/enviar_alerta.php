<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';


try {
    if(!empty($_POST["file"])){
        $data = base64_decode($_POST["file"]);
        file_put_contents($_POST['nombre'].".pdf", $data);
    }else{
        echo "error";
    }

    $mail = new PHPMailer(true);

        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'magiidemonhunter@gmail.com';
        $mail->Password   = 'yfhx ccgq kuve pjag';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Configuración del correo electrónico
        $mail->setFrom('magiidemonhunter@gmail.com', 'Alerta - se ha generado un formato');
        $mail->addAddress('jvp9830@gmail.com', 'Jordan');
        $mail->Subject = 'Formato '. $_POST['nombre'];

        // Adjuntar el archivo PDF
        $mail->addAttachment($_POST['nombre'].".pdf", $_POST['nombre']);

        // Contenido del mensaje (opcional)
        $mail->Body = 'Se adjunta documento generado';

        // Enviar el correo electrónico
        $mail->send();
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}
?>