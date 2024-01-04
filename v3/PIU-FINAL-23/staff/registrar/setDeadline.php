<?php
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['DEADLINE'])){
 $time=$_POST['DEADLINE'];
 include '../../config.php';

 $Query='UPDATE deadline_form SET current=NOW()';
 $stmt=$pdo->prepare($Query);

 if($stmt->execute()){

$is_current=true;
    $Query='INSERT INTO  `deadline_form` (time,current)VALUES(?,?)';
    $stmt=$pdo->prepare($Query);
    $stmt->bindParam(1,$time );
    $stmt->bindParam(2,$is_current);
    $stmt->execute();
    echo "<script>alert('Deadline set');window.location.href='dashboard.php';  </script> ";
 }else{

 }
 


}