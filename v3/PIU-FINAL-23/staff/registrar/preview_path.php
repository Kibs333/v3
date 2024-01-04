<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['STUDENT_ADMISSION'])){
        session_start();
    $_SESSION['student_id']=$_POST['STUDENT_ADMISSION'];
    
    $_SESSION['register-pdf']=true;
    header("location:../../register1.4/pdf_template.php");
    }
    else{die("Admission number not set");}
}else{die("error");}

   