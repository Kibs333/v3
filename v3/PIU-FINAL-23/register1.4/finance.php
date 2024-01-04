<?php
require_once '../session_security.php';
if(isset($_SESSION["finance.php"])){

require_once '../config.php';
require_once '../functions.php';
echo $currentDateTime=timestamp();
$displayQuery = "SELECT * FROM finance_form;";
$stmt = $pdo->prepare($displayQuery);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if ($data) {
    $requestsQuery = "SELECT COUNT(*) as number_of_requests FROM finance_form WHERE request = 1;";
    $stmt = $pdo->prepare($requestsQuery);
    $stmt->execute();
    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    $number_of_requests = $count['number_of_requests'];
} else {$number_of_requests = 0;}

$displayRequestQuery = "SELECT * FROM finance_form WHERE request = 1;";
$stmt = $pdo->prepare($displayRequestQuery);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);}
else{header("location:../staff/staff.php");}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Authentication</title>
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
                    <p class="auth">Finance Approval Requests</p>
                </div>
            </div>
            <div class="total-requests">
                <h2>Total Requests -><?php echo $number_of_requests;?></h2>
            </div>
            <div class="request">
                <?php
                foreach ($data as $row) {
                    echo '<div class="request-data">';
                    if (!is_null($row["registrar_request"])){
                        echo '<p>Request from Registrar to approve-></p>';

                    }
                   
                    echo '<p>Name -> ' . $row["students_name"] . '</p>';
                    echo '<p>Admission No -> ' . $row["students_adm"] . '</p>';
                    echo '<p>Mpesa Message -> ' . $row["mpesa_message"] . '</p>';
                    echo '<p>Bank Message -> ' . $row["bank_message"] . '</p>';
                    echo '<p>Transaction Date -> ' . $row["transaction_date"] . '</p>';
                    echo '<div class="buttons">';
                    echo '<form action="" method="post">';
                    echo '<button type="submit"name="approved_' . $row["students_adm"] . '">Approve to register</button>';
                    echo '<button type="submit" name="reject_' . $row["students_adm"] . '" class="red">Reject</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';

                    $var = 'approved_' . $row['students_adm'];
                    $var2 = 'reject_' . $row['students_adm'];
                    $id = $row['student_id'];

                    if (isset($_POST[$var])) {
                        $approved = 'Approved';
                        $request = 'full_filled';
                        $update = 'UPDATE finance_form SET details_approved = ?, request = ?,cleared_to_register_on=? WHERE student_id = ?;';
                        $stmt = $pdo->prepare($update);
                        $stmt->bindParam(1, $approved);
                        $stmt->bindParam(2, $request);
                        $stmt->bindParam(3,$currentDateTime);
                        $stmt->bindParam(4, $id);
                       
                     
                        if($stmt->execute())
                        {
                        echo '<script>
                            setTimeout(function() {
                                window.location.href = "finance.php";
                            }, 10); 
                        </script>';}
                    }

                    if (isset($_POST[$var2])) {
                        $reject = 'rejected';
                        $request = 'full_filled';
                        $update = 'UPDATE finance_form SET details_rejected = ?, request = ?,cleared_to_register_on=? WHERE student_id = ?;';
                        $stmt = $pdo->prepare($update);
                        $stmt->bindParam(1, $reject);
                        $stmt->bindParam(2, $request);
                        $stmt->bindParam(3,$currentDateTime);
                        $stmt->bindParam(4, $id);
                       
                        if($stmt->execute())
                        {
                        echo '<script>
                            setTimeout(function() {
                                window.location.href = "finance.php";
                            }, 10); 
                        </script>';}
                    }
                }

              
                ?>

            </div>
        </div>
    </div>
</body>
</html>