<?php include '../../../config.php';
  
  if(isset($_POST['announcement'])){
   $message=htmlspecialchars($_POST['announcement']);
   $student_category=htmlspecialchars($_POST['student_category']);
   $student_school=htmlspecialchars($_POST['student_school']);
   $announcement='INSERT INTO student_announcements(message,student_category,student_school)  VALUES(?,?,?)';
   $stmt=$pdo->prepare($announcement);
   $stmt->bindParam(1,$message);
   $stmt->bindParam(2,$student_category);
   $stmt->bindParam(3,$student_school);
    if($stmt->execute()){
       echo "<script>alert('message posted');window.location.href='../dashboard.php';</script>";
       }
}
