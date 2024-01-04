<?php

if($_SERVER["REQUEST_METHOD"]=="GET"){

    if(isset($_GET['STUDENT_ADMISSION'])){
        include '../../config.php';
      $student_admission=$_GET['STUDENT_ADMISSION'];
      $Query='SELECT * from students_form WHERE admission_number=?';
      $stmt=$pdo->prepare($Query);
      $stmt->bindParam(1,$student_admission);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      $finance='SELECT * from finance_form WHERE students_adm=?';
      $stmt=$pdo->prepare($finance);
      $stmt->bindParam(1,$student_admission);
      $stmt->execute();
      $finance = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$finance){
  $finance['details_rejected']="No Request Submitted";
  $finance['details_approved']="No Request Submitted";
  $ff=false;
}else{ $ff=true;}
      
 //   <td>" . (($result['has_registered'] == 0) ? '<i class="material-icons red">priority_high</i> ' : '<i class="material-icons green">done_all</i>') . "</td>
    //   <td>" . (($result['has_submitted_registration_form']==0) ? '<i class="material-icons red">priority_high</i> ' : '<i class="material-icons green">done_all</i>'). "</td>
    //   <td>" .  (($result['registrar_approve']==0) ? '<i class="material-icons red">priority_high</i> ' : '<i class="material-icons green">done_all</i> ') . "</td>
    //   <td>" .  (($result['registrar_disapprove']==0) ? '<i class="material-icons red">priority_high</i> ' : '<i class="material-icons green">done_all</i>'). "</td>
    //   <td>" . (($result['path']==0) ? '<i class="material-icons red">priority_high</i> ' : '<i class="material-icons green">done_all</i>') . "</td>
if ($result){
     session_start();
      $_SESSION['student_id']=$result['id'];
      echo "<table>
      <tr>
        <th>Adm NO</th>
        <th>Registration Status</th>
        <th>Finance Approval</th>
        <th>Registration Form Submission</th>
        <th>Registrar Approval</th>
        <th>Registrar Disapproval</th>
        <th>Registration Document</th>
      </tr>
      <tr>
        <td>" . $result['admission_number'] . "</td>
    
        <td>" . (($result['has_registered'] == 0) ? '<i class="material-icons red">priority_high</i> ' : '<i class="material-icons green">done_all</i>') . "</td>
        <td>" . (($finance['details_rejected']=="rejected") ? 'Rejected by finance' :($finance['details_approved']=='1' ? 'Waiting for approval' : $finance['details_approved'] )  ). "</td>
        <td>" . (($result['has_submitted_registration_form']==0) ? '<i class="material-icons red">priority_high</i> ' : '<i class="material-icons green">done_all</i>'). "</td>
        <td>" .  (($result['registrar_approve']==0 && $result['registrar_disapprove']==0 ) ? '<i class="material-icons red">priority_high</i> ' :$result['registrar_approve'] ) . "</td>
        <td>" .  (($result['registrar_approve']==0 && $result['registrar_disapprove']==0 ) ? '<i class="material-icons red">priority_high</i> ' :$result['registrar_disapprove'] ) . "</td>
        <td>" . (($result['path']==0) ? '<i class="material-icons red">priority_high</i> ' : '<form method="post" action="preview_path.php"> <button type="submit" >Preview</button> <input type="hidden" name="STUDENT_ADMISSION" value="'.$result['id'].'"></form>') . "</td>
      </tr>
      </table>";}else{
        die("Student not found.");
      }

    }else{die('No admission number present');
    }


}else{
     die('Error');
     }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   
    <meta charset="UTF-8">\
    <link rel="stylesheet" href="table.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .green{color:green;}
        .red{color:red;}


    </style>
    <style>

.gradient-button {
      display: inline-block;
      padding: 10px 20px;
      font-size: 16px;
      text-align: center;
      text-decoration: none;
      cursor: pointer;
      border-radius: 5px;
      background: linear-gradient(to right, #4CAF50, #45a049);
      color: #fff;
      border: none;
    }

    .gradient-button:hover {
      background: linear-gradient(to right, #45a049, #4CAF50);
    }
    form{
        display: flex;
    justify-content: center;
    gap: 2rem;
    align-items: center;
    }
    </style>
  
    <title>Document</title>
</head>
<body>

<form action="registrar_student_change_request.php" method="post">

<?php   
 $feedback=[];
if (isset($finance) && $ff==true ){


if($finance['details_rejected']=="rejected"){

  if(is_null($finance['registrar_request'])){
    echo '<button type="submit" name="rfta"class="gradient-button">Request finance to Approve </button> ';
    $_SESSION['rfta']=true;
  }
  else{
    $feedback[]="Registrar Request Submitted to finance";
   

  }


}



if(!$result['registrar_disapprove']==0 && !is_null($result['registrar_disapprove']) ){

  echo '<button type="submit" name="atr"class="gradient-button">Revoke registrartion Disapproval</button>';
  echo '<button type="submit" name="rrf"class="gradient-button">Regive registration form</button>';
}



}
foreach($feedback as $x){

  echo $x;
}

?>


</form>


</body>
</html>