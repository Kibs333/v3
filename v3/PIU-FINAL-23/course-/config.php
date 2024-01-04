<?php
$dsn="mysql:host=localhost;dbname=sicklywa_evaluation_piu";
$dbusername="sicklywa_masterresearch_piu";
$dbpassword="master8606research_piu";


try {
    
    $pdo= new PDO($dsn,$dbusername,$dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed :".$e->getMessage();
   
}

?>