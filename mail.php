<?php

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer.php';
require 'SMTP.php';
require 'OAuth.php';
require 'Exception.php';
require 'POP3.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

//Server settings
$mail->SMTPDebug = 0; // Enable verbose debug output
$mail->isSMTP(); // Send using SMTP
$mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->Username = 'devendrapoonia9983@gmail.com'; // SMTP username
$mail->Password = '9509157279'; // SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
$mail->Port = 465; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

//Recipients
$mail->setFrom('no-reply@blog.com', 'Blog');
$mail->addAddress('devendrapoonia9983@gmail.com', 'Me'); // Add a recipient
$mail->addReplyTo('devendrapoonia9983@gmail.com', 'Information');

// Content
$mail->isHTML(true); // Set email format to HTML
$mail->Subject = 'Here is the subject';
$mail->Body = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

$mail->send();

?>
