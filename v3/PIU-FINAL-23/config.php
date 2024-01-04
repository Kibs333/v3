<?php
$dsn="mysql:host=localhost;dbname=sicklywa_v3";
$dbusername="root";
$dbpassword="";

try {
    $pdo= new PDO($dsn,$dbusername,$dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed :".$e->getMessage();
   }