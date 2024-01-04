<?php

//include 'https://portal.sicklywall.com/session_security.php';
include '../../session_security.php';
if(!isset($_SESSION['finance.php'])){
echo 'alert';
  //header("location:https://portal.sicklywall.com");

}




if($_SERVER['REQUEST_METHOD']=="POST"){
    include '../../config.php';
    require '../../functions.php';
    $currentDateTime=timestamp();
    if(isset($_POST['STD_ADM'])){
        
        $student_id=htmlspecialchars($_POST['STD_ID']);
        $student_adm=htmlspecialchars($_POST['STD_ADM']);
        $student_id=null;

        
        $update = 'UPDATE finance_form SET student_id=? WHERE students_adm=? ;';
        $stmt = $pdo->prepare($update);
        $stmt->bindParam(1,$student_id);
        $stmt->bindParam(2,$student_adm);
        
        
        if($stmt->execute()){


            echo "<script>alert('Command Executed');window.location.href='dashboard.php';  </script> ";
        }


    }
}