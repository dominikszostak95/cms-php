<?php

$mail = new PHPMailer(true);

$mail->isSMTP();// Set mailer to use SMTP
$mail->CharSet = "utf-8";// set charset to utf8
$mail->SMTPAuth = true;// Enable SMTP authentication
$mail->SMTPSecure = 'tls';// Enable TLS encryption, `ssl` also accepted

$mail->Host = 'smtp.gmail.com';// Specify main and backup SMTP servers
$mail->Port = 587;// TCP port to connect to
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$mail->isHTML(true);// Set email format to HTML

$mail->Username = 'ddumel55@gmail.com';// SMTP username
$mail->Password = 'dumelu10';// SMTP password

$mail->setFrom('ddumel55@gmail.com', 'Sklep Komputerowy');//Your application NAME and EMAIL
