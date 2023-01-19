<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/PHPMailer/src/Exception.php';
require 'vendor/phpmailer/PHPMailer/src/PHPMailer.php';
require 'vendor/phpmailer/PHPMailer/src/SMTP.php';

require_once "vendor/autoload.php";

function sendMail($data) {    
    $phpmailer = new PHPMailer(true);
    
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = 'fceb6735f872af';
    $phpmailer->Password = '7718386ca97739';

    $mail->From = 'kyrvim@gmail.com';
    $mail->FromName = 'Carlos Ferreira';
    
    $mail->addAddress($data['to_mail'], $data['to_name']);
    $mail->addReplyTo($data['cc_mail'], $data['cc_name']);
    
    $mail->isHTML(true);
    
    $body = "<h5>Dados da Empresa:</h5>";
    $body .= "<P><b>Razão Social: </b>" . $data['body']['social_reason'] . "</p>";
    $body .= "<P><b>Capital Social: </b>" . $data['body']['social_capital'] . "</p>";
    $body .= "<P><b>Porte: </b>" . $data['body']['porte'] . "</p>";
    $body .= "<P><b>Endereço: </b>" . $data['body']['address'] . "</p>";
    
    $mail->Subject = "Novo registro no sistema";
    $mail->Body = $body;
    
    try {
        $mail->send();
        echo "Menssagem enviada com sucesso.";
    } catch (Exception $e) {
        echo "Erro de envio: " . $mail->ErrorInfo;
    }
}