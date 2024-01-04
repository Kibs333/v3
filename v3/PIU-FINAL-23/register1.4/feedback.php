<?php
require_once '../session_security.php';

if(isset($_SESSION['feedback.php'])){
require_once '../config.php';

$displayQuery = "SELECT * FROM feedback_form;";
$stmt = $pdo->prepare($displayQuery);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if ($data) {

    $requestsQuery = "SELECT COUNT(*) as number_of_feedback_sent FROM feedback_form WHERE seen IS NULL";
    $stmt = $pdo->prepare($requestsQuery);
    $stmt->execute();
    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    $number_of_feedback_sent =$count['number_of_feedback_sent'];
    
} else {
    $number_of_feedback_sent = 0;
}

$displayRequestQuery = "SELECT * FROM feedback_form WHERE seen IS NULL;";
$stmt = $pdo->prepare($displayRequestQuery);
$stmt->execute();
$feedbackdata = $stmt->fetchAll(PDO::FETCH_ASSOC);}else{
    header("location:../staff/staff.php");
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>feedback</title>
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
                    <p class="auth">Feedback </p>
                </div>
            </div>
            <div class="total-requests">
                <h2>Total feedback -> <?php echo $number_of_feedback_sent; ?></h2>
            </div>
            <div class="request">
                <?php
                foreach ($feedbackdata as $row) {
                    echo '<div class="request-data">';
                    echo '<p>Admission No -> ' . $row["student_id"] . '</p>';
                    echo '<p>device-> ' . $row["device"] . '</p>';
                    echo '<p>Browser -> ' . $row["browser"] . '</p>';
                    echo '<p>Date -> ' . $row["date"] . '</p>';
                    echo '<p>Feedback -> ' . $row["feedback"] . '</p>';

                    echo '<div class="buttons">';
                    echo '<form action="" method="post">';
                    echo '<button type="submit"name="seen_' . $row["student_id"]. $row["id"]  . '">Check as seen</button>';
       
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';

                    $var = 'seen_' . $row['student_id']. $row["id"] ;
 
                    $id = $row['id'];
                    if (isset($_POST[$var])) {
                        $update = 'UPDATE feedback_form SET seen = 1 WHERE id = ? ';
                        $stmt = $pdo->prepare($update);
                        $stmt->bindParam(1, $id);
                    
                        $stmt->execute();
                        echo '<script>
                            setTimeout(function() {
                                window.location.href = "feedback.php";
                            }, 10); 
                        </script>';
                    }

                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
