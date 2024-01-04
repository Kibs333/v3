<?php @require_once 'session_security.php';
$admission=$_SESSION['student_adm'];
$admissionParts = explode("/", $admission);
            
if (count($admissionParts) === 3) {
    $course = $admissionParts[0];
    $id = $admissionParts[1];
    $year = $admissionParts[2];
            
    $_SESSION['std-db-course']=$course;
    $_SESSION['std-db-id']=$id;
    $_SESSION['std-db-year']=$year;
    } else {die("Invalid admission format.");}