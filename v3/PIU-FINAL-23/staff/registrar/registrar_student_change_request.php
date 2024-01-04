<?php
include '../../functions.php';
include '../../config.php';
session_start();
$currentDateTime=timestamp();
// include '../../register1.4/pdf.php';
// die();
if($_SERVER['REQUEST_METHOD']=="POST"){
    if (isset($_POST['atr'])){
        $select = 'SELECT registrar_approve FROM students_form WHERE id=?;';
        $stmt = $pdo->prepare($select);
        $stmt->bindParam(1,$_SESSION['student_id']);

       if($stmt->execute()){

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($data);
//         die();
        if(!$data['registrar_approve']==0){
            echo '<script> alert("Student is already approved");window.history.back();</script>';
            return;
        } 

       }else{ die("error");}

        $update = 'UPDATE students_form SET registrar_disapprove=null, registrar_approve=null,path=null  WHERE id = ?;';
        $stmt = $pdo->prepare($update);
        $stmt->bindParam(1,$_SESSION['student_id']);
     
       if($stmt->execute()){
        //windowLocation(1,'dashboard.php');
       // $_SESSION['register-pdf']=true;
        //$_SESSION['student_id']=$row['id'];
        // include '../../register1.4/pdf.php';
        header("location:../../register1.4/registrar.php");
    
    }else{die("registration approval process failed ");}
    }

//this action will allow the registrar to request  finance to approve on behalf of a student 
elseif(isset($_POST['rfta']) && $_SESSION['rfta']==true){

        $update= 'UPDATE finance_form SET registrar_request =?,request=1 WHERE student_id=?;';
        $stmt = $pdo->prepare($update);
        $stmt->bindParam(1,$currentDateTime);
        $stmt->bindParam(2,$_SESSION['student_id']);

       if($stmt->execute()){
        echo '<script> alert("finance request sent");window.history.back();</script>';

       }

}


//regive registartion form this will remove the student id from the database and set the students registartion progress to null
elseif(isset($_POST['rrf'])){
 echo $changedByRegistrar=$currentDateTime."_".$_SESSION['student_id'];
//  die();
    $updatereg= 'UPDATE piu_registration_form_data SET student_id =? WHERE student_id=?;';
    $stmt = $pdo->prepare($updatereg);
    $stmt->bindParam(1,$changedByRegistrar);
    $stmt->bindParam(2,$_SESSION['student_id']);

   if($stmt->execute()){
      $updatereg= 'UPDATE `students_form` SET `has_registered`=0,`has_submitted_registration_form`=NULL,`registrar_approve`=NULL,`registrar_disapprove`=NULL,`path`=NULL WHERE id=?;';
      $stmt = $pdo->prepare($updatereg);
      $stmt->bindParam(1,$_SESSION['student_id']);
      $stmt->execute();
      echo '<script> alert("Registration form has been reset");window.history.back();</script>';
   }
}
else{die('no instructions given');}

}