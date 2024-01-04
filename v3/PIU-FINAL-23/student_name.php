<?php @require_once 'session_security.php';

$_SESSION['email']=$row['student_email'];
$email =$row['student_email'];
 
$emailParts = explode("@", $email);

if (count($emailParts) === 2) {
    $namePart = $emailParts[0];
    $nameParts = explode(".", $namePart);
            
     if (count($nameParts) === 2) {
         $firstName = $nameParts[0];
         $lastName = $nameParts[1];

         $_SESSION['fname']=$firstName;
         $_SESSION['lname']=$lastName;
         $_SESSION['full_name']=$firstName ." ".$lastName;

                } else {die("Invalid email format (name.lastname@test.com).");}
            } else { die("Invalid email format (name.lastname@test.com).");}
            