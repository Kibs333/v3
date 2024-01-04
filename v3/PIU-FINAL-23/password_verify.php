<?php
@require_once 'config.php';@require_once 'session_security.php';

if(isset($_POST['submit'])&& $_SERVER['REQUEST_METHOD']=="POST")
{
 $username = htmlspecialchars( $_POST['username']);
 $email = htmlspecialchars($_POST['email']);
 $loginpass = ($_POST['password']);

 $select =" SELECT * FROM students_form WHERE student_email =?";
 $stmt=$pdo->prepare($select);
 $stmt->bindparam(1,$email);
 $stmt->execute();
 $row = $stmt->fetch(PDO::FETCH_ASSOC);

 if($row)
 {
  $hashedpwd=$row['password'];
  if(password_verify($loginpass,$hashedpwd))
  {
   $_SESSION['allowed']=true;
   $_SESSION['student_id']=$row['id'];
   $_SESSION['student_adm']=$row['admission_number'];

   @include 'student_name.php';
   @include 'student_adm.php';
   header('location:portal.php');
 }
 else
 {$error[] ='Wrong  Password  !';}
 }
 else
 {$error[] ='Email or password  incorrect!';}
}