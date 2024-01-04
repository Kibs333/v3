<?php
date_default_timezone_set('Africa/Nairobi');
$Query='SELECT * FROM deadline_form WHERE current=1';
$stmt=$pdo->prepare($Query);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);
//die(var_dump($data));
// Set the target time (2024-01-08T12:00)
$targetTime = strtotime($data['time']);
$deadline=$data['time'];
// Get the current time
$currentTime = time();

// Compare the current time with the target time
if ($currentTime >= $targetTime) {
// echo "Current time is greater than 2024-01-08T12:00";

$_SESSION['finance'] = false;
$_SESSION['register-token'] = false;


$deadline_auth=false;


} else {
// echo "Current time is not greater than 2024-01-08T12:00";
$deadline_auth=true;



}






