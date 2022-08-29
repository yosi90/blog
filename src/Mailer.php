<?php

use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    public function __construct($correo, $nombre, $asunto, $url, $tipo)
    {
        $mail = new PHPMailer();
        $mail->CharSet = "UTF-8";
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->Port = 25;
        $mail->SMTPAuth = true;
        $mail->Username = 'yosi_ofra@hotmail.com';
        $mail->Password = '%191G;f+d';
        $mail->SMTPAutoTLS = true;
        $mail->setFrom('yosi_ofra@hotmail.com', 'Yosiftware');
        $mail->addAddress($correo, $nombre);
        $mail->Subject = $asunto;
        switch ($tipo) {
            case 'act':
                $mail->Body = 'http://localhost:8080/blog/act-acc/' . $url;
                break;
            case 'rec':
                $mail->Body = 'http://localhost:8080/blog/rec-pass/' . $url;
                break;
            default:
                break;
        }
    }
}
