<?php
echo "hey";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
   // echo "hey";
    // Retrieve data from the $_GET superglobal
    $name = $_GET["table"];
    $unitcode = $_GET["unitcode"];
    $unitname = $_GET["unitname"];
    $lecname = $_GET["lecname"];

    $semester = $_GET["semester"];
    $year = $_GET["year"];
    $yos = $_GET["yos"];

    session_start();
    $_SESSION['tableName']=$name;

    $_SESSION['unitcode']=$unitcode;
    $_SESSION['unitname']=$unitname;
    $_SESSION['lecname']=$lecname;
    $_SESSION['semester']=$semester;
    $_SESSION['year']=$year;
    $_SESSION['yos']=$yos;

    $_SESSION['evalForm']=true;
    
    header("location:project-form.php");
}else{die('not allwed');}
?>