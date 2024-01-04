<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail= new PHPMailer(true);
$mail->isSMTP();

$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = 'blogspotpioneer@gmail.com';
$mail->Password = 'crpb vnbl zoca ilab';
$mail->setFrom('blogspotpioneer@gmail.com');
