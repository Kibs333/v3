<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
include 'config.php';
   $username=htmlspecialchars($_POST['username']);
   $userPassword=htmlspecialchars($_POST['password']);

   $query="SELECT * FROM staff_piu WHERE username=? ";
   $stmt=$pdo->prepare($query);
   $stmt->bindparam(1,$username);

   if($stmt->execute()){
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if($data){
        $hashedpwd=$data['password'];
        if(password_verify($userPassword,$hashedpwd)){
          $page=$data['permission'];
          if(empty($page)){
             die('Permission not set');
             }else{session_start();
                  $_SESSION[$page]=true;
                  if($username=="registrar"){
                    header("location: registrar/dashboard.php");
                  }
                  elseif($username=="finance"){
                    header("location: finance/dashboard.php");

                  }
                  else{
                  //remember to add the location url https://portal.sicklywall.com/
                 header("location: ../register1.4/$page");}
                 }
        }else{die("Wrong username or password");}

    }else{

        die("Wrong username or password");
    }

   }else{

    die('Error Try again later');
   }

}
else{ 
    die("Invalid Request");
}