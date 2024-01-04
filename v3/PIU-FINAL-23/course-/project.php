<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    //$year = $_POST["year"];
   // $sem = $_POST["semester"];
    $one = $_POST["1"];
    $two = $_POST["2"];
    $three = $_POST["3"];
    $four = $_POST["4"];
    $five = $_POST["5"];
    $six = $_POST["6"];
    $seven = $_POST["7"];
    $eight = $_POST["8"];
    $nine = $_POST["9"];
    $ten = $_POST["10"];
    $eleven = $_POST["11"];
    $twelve = $_POST["12"];
    $thirteen = $_POST["13"];
    $fourteen = $_POST["14"];
    $fifteen = $_POST["15"];
    $sixteen = $_POST["16"];
    $seventeen = $_POST["17"];
    $eighteen = $_POST["18"];
    $nineteen = $_POST["19"];
    $twenty = $_POST["20"];
    $twenyone = $_POST["21"];
    $twentytwo = $_POST["22"];
    $twentythree = $_POST["23"]; 
    $bestaspects = $_POST["bestaspects"]; 
    $improvedaspects = $_POST["improvedaspects"];
    include "config.php";
    $tableName = $_SESSION['tableName'];
    $serial_no=$_SESSION['student_id'];

$insert = "INSERT INTO `$tableName` (serial_id, col1, col2, col3, col4, col5, col6, col7, col8, col9, col10, col11, col12, col13, col14, col15, col16, col17, col18, col19, col20, col21, col22, col23, bestaspects, improvedaspects) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";

$stmt = $pdo->prepare($insert);

$stmt->bindParam(1, $serial_no);
$stmt->bindParam(2, $one);
$stmt->bindParam(3, $two);
$stmt->bindParam(4, $three);
$stmt->bindParam(5, $four);
$stmt->bindParam(6, $five);
$stmt->bindParam(7, $six);
$stmt->bindParam(8, $seven);
$stmt->bindParam(9, $eight);
$stmt->bindParam(10, $nine);
$stmt->bindParam(11, $ten);
$stmt->bindParam(12, $eleven);
$stmt->bindParam(13, $twelve);
$stmt->bindParam(14, $thirteen);
$stmt->bindParam(15, $fourteen);
$stmt->bindParam(16, $fifteen);
$stmt->bindParam(17, $sixteen);
$stmt->bindParam(18, $seventeen);
$stmt->bindParam(19, $eighteen);
$stmt->bindParam(20, $nineteen);
$stmt->bindParam(21, $twenty);
$stmt->bindParam(22, $twenyone);
$stmt->bindParam(23, $twentytwo);
$stmt->bindParam(24, $twentythree);
$stmt->bindParam(25, $bestaspects);
$stmt->bindParam(26, $improvedaspects);

if($stmt->execute())
{echo "<script>alert('Thank You.PIONEER INTERNATIONAL UNIVERSITY.Powered by Intellect, Driven by values.');window.location.href='student.php';</script>";}else{echo "<script>alert('ERROR ') </script>";}    
}
