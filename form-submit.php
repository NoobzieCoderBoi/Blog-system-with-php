<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer.php';
require 'SMTP.php';
require 'OAuth.php';
require 'Exception.php';
require 'POP3.php';

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$html = "<p>New Form Submission</p><br><br>";
$html .= "Name: <b>$name</b><br><br>";
$html .= "Email: <b>$email</b><br><br>";
$html .= "Subject: <b>$subject</b><br><br>";
$html .= "Message: <b>$message</b><br><br>";

$mail = new PHPMailer(true);

//Server settings
$mail->SMTPDebug = 0; // Enable verbose debug output
$mail->isSMTP(); // Send using SMTP
$mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->Username = 'EMAIL'; // SMTP username
$mail->Password = 'PASSWORD'; // SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
$mail->Port = 465; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

//Recipients
$mail->setFrom('no-reply@blog.com', 'Blog');
$mail->addAddress('reply@adress', 'Me'); // Add a recipient
$mail->addReplyTo('replyto@adress', 'Information');

// Content
$mail->isHTML(true); // Set email format to HTML
$mail->Subject = 'New form Submission';
$mail->Body = $html;
$mail->AltBody = $html;
if ($mail->send()) {
    echo 'Mail Sent Successfully.';
} else {
    echo 'Something Went Wrong.';
}
