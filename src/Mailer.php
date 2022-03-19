<?php

use PHPMailer\PHPMailer\PHPMailer as Pedro;
use PHPMailer\PHPMailer\SMTP;

class Mailer
{
    public function __construct()
    {
        /**
         * This example shows making an SMTP connection with authentication.
         */

        //Create a new PHPMailer instance
        $mail = new Pedro();
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        //SMTP::DEBUG_OFF = off (for production use)
        //SMTP::DEBUG_CLIENT = client messages
        //SMTP::DEBUG_SERVER = client and server messages
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        //Set the hostname of the mail server
        $mail->Host = 'mail.example.com';
        //Set the SMTP port number - likely to be 25, 465 or 587
        $mail->Port = 25;
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication
        $mail->Username = 'yourname@example.com';
        //Password to use for SMTP authentication
        $mail->Password = 'yourpassword';
        //Set who the message is to be sent from
        $mail->setFrom('from@example.com', 'First Last');
        //Set an alternative reply-to address
        $mail->addReplyTo('replyto@example.com', 'First Last');
        //Set who the message is to be sent to
        $mail->addAddress('whoto@example.com', 'John Doe');
        //Set the subject line
        $mail->Subject = 'PHPMailer SMTP test';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
        //Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';
        //Attach an image file
        $mail->addAttachment('images/phpmailer_mini.png');

        //send the message, check for errors
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }
    }
}
