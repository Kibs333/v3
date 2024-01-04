<?php
@require_once 'send-auth.php';
@require 'session_security.php';
  $mail->addAddress($_SESSION['email']);
  $mail->Subject =('OTP VERIFICATION');
   // HTML content for the email
 $htmlContent = '<html>
 <head>
   <title>OTP VERIFICATION</title>
  </head>
  <body>

   <p>Your One-Time Password (OTP) for verification is:  '.$_SESSION['otp'].' .</p>

   <p>Please do not share this OTP with anyone. It is valid for a single use and will expire in [1 hour].</p>

   <p>If you did not request this OTP, please ignore this message.</p>

   <p>Thank you.</p>

  </body>
  </html>';
  $mail->isHTML(true);
  $mail->Body = $htmlContent;

   if (!$mail->send()) {
       echo 'Mailer Error: ' . $mail->ErrorInfo;
   } else {echo "<script>alert('Message sent! A OTP has been sent to your email');</script>";}