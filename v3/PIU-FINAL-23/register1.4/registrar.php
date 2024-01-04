<?php
require_once '../session_security.php';
if(isset($_SESSION['registrar.php'])){
require_once '../config.php';
require '../functions.php';
$currentDateTime=timestamp();
$_SESSION['register-pdf']=false;
unset($_SESSION['student_id']); 
$displayQuery = "SELECT * FROM students_form WHERE registrar_approve IS NULL AND has_submitted_registration_form=1;";
$stmt = $pdo->prepare($displayQuery);
if($stmt->execute()){$data = $stmt->fetchALL(PDO::FETCH_ASSOC); }
else{die("Error student form did not relay data");}
if ($data){$number_of_requests = count($data);}else {$number_of_requests = 0;}}else{header("location:../staff/staff.php");}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Approval Requests</title>
    <link rel="stylesheet" href="resources/css/finance.css">
    <link rel="icon" type="image/png" sizes="192x192" href="resources/img/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="resources/img/android-chrome-512x512.png">
    <link rel="apple-touch-icon" sizes="180x180" href="resources/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="resources/img/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="resources/img/favicon-32x32.png">
    <link rel="icon" href="resources/img/favicon.ico" type="image/x-icon">
    <link rel="manifest" href="resources/img/site.webmanifest">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <div class="grid-1">
                    <img class="out" src="resources/img/PIU-LOGO-WHITE.png" alt="pioneer international university">
                </div>
                <div class="grid-2">
                    <p class="auth">Registrar Approval Requests</p>
                </div>
            </div>
            <div class="total-requests">
                <h2>Total Requests -><?php echo $number_of_requests;?></h2>
            </div>
            <div class="request">
                <?php
                foreach ($data as $row) {
                    $id = $row['id'];
                    $var = 'approved_'.$row['admission_number'];
                    $var2 = 'reject_'.$row['admission_number'];
                    $preview='preview_'.$row['admission_number'];
                    echo '<div class="request-data">';
                    echo '<p>Admission No ->' . $row["admission_number"] . '</p>';
                    echo '<p>Email -> ' . $row["student_email"] . '</p>';
                    echo '<div class="buttons">';
                    echo '<form action="" method="post">';
                    echo '<button type="submit" style="background:#9c27b0;" name="preview_'.$row["admission_number"].'">Preview Registration form</button><br>';
                    echo '<button type="submit"name="' .$var. '">Approve to register</button>';
                    echo '<button type="submit" name="'. $var2. '" class="red">Reject</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                       //preview reg form
                    if(isset($_POST[$preview])){
                        $_SESSION['register-pdf']=true;
                        $_SESSION['student_id']=$row['id'];
                        echo "<script>window.open('pdf_template.php', '_blank');</script>";  

                    }
                
                    if (isset($_POST[$var])){
                        $update = 'UPDATE students_form SET registrar_approve =? WHERE id = ?;';
                        $stmt = $pdo->prepare($update);
                        $stmt->bindParam(1,$currentDateTime);
                        $stmt->bindParam(2,$id);
                     
                       if($stmt->execute()){windowLocation(1,'registrar.php');
                        $_SESSION['register-pdf']=true;
                        $_SESSION['student_id']=$row['id'];
                        include 'pdf.php';}else{die("registration approval process failed for var1");}
                    }

                    if (isset($_POST[$var2])) {
                        $value=0;
                        $update = 'UPDATE students_form SET registrar_disapprove = ?,registrar_approve = ? WHERE id = ?;';
                        $stmt = $pdo->prepare($update);
                        $stmt->bindParam(1,$currentDateTime);
                        $stmt->bindParam(2,$value);
                        $stmt->bindParam(3,$id);
                        if($stmt->execute()){windowLocation(1,'registrar.php');}else{die("registration approval  process failed for var2");}
                 }
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>