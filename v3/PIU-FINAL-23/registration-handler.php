<?php
require_once 'config.php';
require_once 'session_security.php';

$student_check_query = "SELECT * FROM students_form WHERE id=?";
$student_stmt = $pdo->prepare($student_check_query);
$student_stmt->bindParam(1, $_SESSION['student_id']);
if($student_stmt->execute())
{ 
// Fetch the result as an associative array
$data = $student_stmt->fetch(PDO::FETCH_ASSOC);

$has_registered = $data['has_registered'];
$has_submitted = $data['has_submitted_registration_form'];
$registrar_approval = $data['registrar_approve'];
  
                       
if ($has_registered == 0) {
    
      if($has_submitted == 0) {
         $reg_status_color = "red";
         $reg_button_color = "red";
         $reg_status = "Not Started";
         $reg_button_status = "";
         if (isset($_POST['register'])) {
             $_SESSION['finance'] = true;
             header('location: register1.4/finance-form.php');
              }
             }
             else{

                      if ($data['registrar_disapprove']=='') {
                          $reg_button_status = "disabled='disabled'";
                          $reg_status = "Application submitted to Registrar. Check back later.";
                          $reg_status_color = "green";
                          $reg_button_color = "grey";
                          return;
                         }
                      else  {

                          if($data['registrar_approve']==0){
                         $reg_button_status = "disabled='disabled'";
                          $reg_status = "Application rejected by Registrar. Please visit the Registrar's office.";
                          $reg_status_color = "red";
                          $reg_button_color = "grey";
                          return;
                          }

                         }
                       }
    // Check whether the student is allowed to register
    $check_query = "SELECT * FROM finance_form WHERE student_id=?";
    $check_stmt = $pdo->prepare($check_query);
    $check_stmt->bindParam(1, $_SESSION['student_id']);
    if($check_stmt->execute()){
       // Fetch the result as an associative array
       $data_check = $check_stmt->fetch(PDO::FETCH_ASSOC);
        if ($data_check) {
            $approved = $data_check['details_approved'];
            $rejected = $data_check['details_rejected'];
            // If allowed to register, give access
             if ($approved == "Approved") {
                 $reg_status = "Authorized to register";
                 $reg_status_color = "green";
                 $reg_button_color = "green";
                 $reg_button_status = "";
                 $_SESSION['student_can_reg'] = 1;
                  if (isset($_POST['register'])) {
                      header('location: register1.4/check_registeration_log.php');
                      $_SESSION['register-token'] = true;
            }
        }
                 // If the student is not allowed to register
                elseif ($rejected == "rejected") {
                        $reg_status = "Application Rejected. Visit Finance Office";
                        $reg_status_color = "red";
                        $reg_button_color = "grey";
                        $reg_button_status = "disabled='disabled'";
                        }
        
                else{
                    $reg_status = "Pending Finance Approval";
                    $reg_status_color = "green";
                    $reg_button_color = "grey";
                    $reg_button_status = "disabled='disabled'";
                    }
                    
    } else{$reg_status_color = "red";
           $reg_button_color = "red";
           $reg_status = "Not Started";
           $reg_button_status = "";
           if (isset($_POST['register'])) {
               $_SESSION['finance'] = true;
               header('location: register1.4/finance-form.php');
              }
    }
    }
    
}else{
     $reg_button_status = "disabled='disabled'";
     $reg_status = "successful";
     $reg_status_color = "green";
     $reg_button_color = "grey";
    

}





}else{die("Error !! report to Admin");}
                  