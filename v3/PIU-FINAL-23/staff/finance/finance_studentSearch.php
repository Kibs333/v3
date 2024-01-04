
<?php

//include 'https://portal.sicklywall.com/session_security.php';
include '../../session_security.php';
if(!isset($_SESSION['finance.php'])){
echo 'alert';
  //header("location:https://portal.sicklywall.com");

}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Search Data</title>
    <link rel="stylesheet" href="../registrar/table.css">
</head>
<body>
<?php
 if($_SERVER['REQUEST_METHOD']=="GET"){
    include '../../config.php';
    if(isset($_GET['STUDENT_ADMISSION'])){

        $student_adm=htmlspecialchars($_GET['STUDENT_ADMISSION']);  

        $select = 'SELECT * FROM finance_form WHERE students_adm=?;';
        $stmt = $pdo->prepare($select);
        $stmt->bindParam(1,$student_adm);
        
        
        if($stmt->execute()){
        
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if($data){
//                 `cleared_to_register_on`
// `details_rejected`
// `details_approved`


                echo "<table>
                <tr>
                  <th>Adm NO</th>
                  <th>Finance Approval</th>
                  <th>Registartion clearance</th>
                  <th>Registrar request</th>

                </tr>
                <tr>
                <td>".$data['students_adm']."</td>
                <td>" . (($data['details_rejected']=="rejected") ? 'Rejected by finance' :($data['details_approved']=='1' ? 'Waiting for approval' : $data['details_approved'] )  ). "</td>
                <td>".$data['cleared_to_register_on']."</td>
                <td>".$data['registrar_request']."</td>

                
                
                </tr>
                </table>";

                if($data['details_rejected']=="rejected" && is_null($data['registrar_request'])){

                       if($data['student_id']==0){

echo 'registration  disapproval revoked';
                        return;

                       }
                    echo '<form action="revoke.php" method="post">
                          <input type="hidden" name="STD_ADM" value='.$data['students_adm'].'>
                          <input type="hidden" name="STD_ID" value='.$data['student_id'].'>
                          
                         <button type="submit">REVOKE DISAPPROVAL</button>
                          </form>
                    
                    
                    ';
                }


        
            }else{
                die("Student Not found");
            }
        }else{
            die("Error");
        }


    }
    else{
        die("Admission no set");
    }






}else{
    die("ERROR");
}?>
</body>
</html>
