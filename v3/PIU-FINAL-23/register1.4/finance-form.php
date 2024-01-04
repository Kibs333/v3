<?php
@require_once '../session_security.php';
@require_once '../config.php';

include '../functions.php';
if ($_SESSION['allowed'] == true && isset($_SESSION['student_id']) && isset($_SESSION['full_name']) && isset($_SESSION['finance'])) {
    $select = "SELECT * FROM finance_form WHERE student_id=?";
    $stmt = $pdo->prepare($select);
    $stmt->bindParam(1, $_SESSION['student_id']);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($data) {
        echo '<script>
            alert("You have already submitted a request.Check your registration status.");
            setTimeout(function() {
                window.location.href = "../portal.php";
            }, 100);
        </script>';
    }
    if (isset($_POST['auth'])) 
    {
        $Request = 1;
        $mpesa_message = htmlspecialchars($_POST['mpesa']);
        $conso_bank = htmlspecialchars($_POST['conso_bank']);
        $transaction_date = htmlspecialchars($_POST['date']);
        $declare = htmlspecialchars($_POST['declare']);
        
if (empty($mpesa_message) || empty($conso_bank) || empty($transaction_date) || empty($declare)) {
    echo "Please fill in all required fields.";
    } else {
        $checkautoapprove = "SELECT * FROM auto_approve WHERE adm=?";
        $stmt = $pdo->prepare($checkautoapprove);
        $stmt->bindParam(1, $_SESSION['student_adm']);
        $stmt->execute();
        $data_autoapprove = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($data_autoapprove);
        // die();
      if($data_autoapprove){



        $Request="auto_approved";
        $details="Approved";
             
    $finance = "INSERT INTO finance_form (request, mpesa_message, bank_message, transaction_date, has_declared, students_name, students_adm, student_id,details_approved,cleared_to_register_on) VALUES (?,?,?,?,?,?,?,?,?,?);";
    $stmt = $pdo->prepare($finance);
    $stmt->bindParam(1, $Request);
    $stmt->bindParam(2, $mpesa_message);
    $stmt->bindParam(3, $conso_bank);
    $stmt->bindParam(4, $transaction_date);
    $stmt->bindParam(5, $declare);
    $stmt->bindParam(6, $_SESSION['full_name']);
    $stmt->bindParam(7, $_SESSION['student_adm']);
    $stmt->bindParam(8, $_SESSION['student_id']);
    $stmt->bindParam(9, $details);
    $stmt->bindParam(10,timestamp());
    if ($stmt->execute()) {
        echo '<script>alert("Request Submitted. Check back later.");setTimeout(function(){window.location.href = "../portal.php";}, 100);</script>';
        } else {
        echo '<script>alert("Request Failed");</script>';
        return;
       }

      }else{
             
    $finance = "INSERT INTO finance_form (request, mpesa_message, bank_message, transaction_date, has_declared, students_name, students_adm, student_id) VALUES (?,?,?,?,?,?,?,?);";
    $stmt = $pdo->prepare($finance);
    $stmt->bindParam(1, $Request);
    $stmt->bindParam(2, $mpesa_message);
    $stmt->bindParam(3, $conso_bank);
    $stmt->bindParam(4, $transaction_date);
    $stmt->bindParam(5, $declare);
    $stmt->bindParam(6, $_SESSION['full_name']);
    $stmt->bindParam(7, $_SESSION['student_adm']);
    $stmt->bindParam(8, $_SESSION['student_id']);
    if ($stmt->execute()) {
        echo '<script>alert("Request Submitted. Check back later.");setTimeout(function(){window.location.href = "../portal.php";}, 100);</script>';
        } else {
        echo '<script>alert("Request Failed");</script>';
       }

      }

   
   }

    }
} else {header('location: ../log-in.php');}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="stylesheet" href="resources/css/finance-form.css">
    <title>finance form</title>
    
    <link rel="stylesheet" href="resources/css/finance.css">
    <link rel="icon" type="image/png" sizes="192x192" href="resources/img/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="resources/img/android-chrome-512x512.png">
    <link rel="apple-touch-icon" sizes="180x180" href="resources/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="resources/img/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="resources/img/favicon-32x32.png">
    <link rel="icon" href="resources/img/favicon.ico" type="image/x-icon">
    <link rel="manifest" href="resources/img/site.webmanifest">
    <style> .header{ display:unset;}</style>
</head>
<body>
<form action="" method="POST">
    <div class="header">
        <h1>Finance Form</h1>
    </div>

    <div class="mpesa">
        <label for="mpesa">Mpesa Message *</label><br>
        <textarea name="mpesa" placeholder="Copy-paste the whole Mpesa message here" id="mpesa" cols="30" rows="10" required></textarea><br><br>
    </div>

    <div class="conso">
        <label for="Conso">Conso Bank Message *</label><br>
        <textarea name="conso_bank" placeholder="Copy-paste the whole Consolidated Bank of Kenya message here" id="Conso" cols="30" rows="10" required></textarea><br><br>
    </div>

    <div class="date">
        <label for="mpesa-time">Transaction Date *</label>
        <input type="datetime-local" name="date" id="mpesa-time" placeholder="YYYY-MM-DDTHH:MM" required><br><br>
    </div>

    <div class="declare">
        <input type="checkbox" name="declare" id="declare" required>
        <label  for="declare">I declare that the details above are true</label>
    </div>

    <div class="button">
        <button type="submit" id="submit" name="auth">Submit</button>
    </div>
</form>
<script>
window.onload = function() {
    var mpesa = document.getElementById("mpesa");
    var conso = document.getElementById("Conso");
    var mpesaTime = document.getElementById("mpesa-time");
    var declare = document.getElementById("declare");
    var btn = document.getElementById("submit");

    btn.addEventListener('click', function () {
        if (mpesa.value === "" || conso.value === "" || mpesaTime.value === "" || declare.value === "") {
            if (mpesa.value === "") {
                mpesa.style.border = "1px solid red";
                mpesa.focus();
            } else {
                mpesa.style.border = "";
            }

            if (conso.value === "") {
                conso.style.border = "1px solid red";
                conso.focus();
            } else {
                conso.style.border = "";
            }

            if (mpesaTime.value === "") {
                mpesaTime.style.border = "1px solid red";
                mpesaTime.focus();
            } else {
                mpesaTime.style.border = "";
            }

            if (declare.value === "") {
                declare.style.border = "1px solid red";
                declare.focus();
            } else {
                declare.style.border = "";
            }
        }
    });
};
</script>
</body>
</html>