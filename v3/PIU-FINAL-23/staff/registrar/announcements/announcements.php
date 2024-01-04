<?php
include '../../../config.php';
$select_announcement = 'SELECT * FROM student_announcements WHERE active IS NULL ';

$stmt=$pdo->prepare($select_announcement);


if($stmt->execute()){
    $data_select_announcements = $stmt->fetchALL(PDO::FETCH_ASSOC);


}else{die("error");}
// include 'display_announcements.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../table.css">
</head>
<body>
    
<!-- <div class="announcement_form">
 <form action="make_announcement.php" method="post">
  <button type="submit" name="make_announcements">POST</button>
 </form>
</div> -->

<?php
if(isset($data_select_announcements)){
   foreach ($data_select_announcements as  $value) 
   {
// var_dump($value['archive']);
// die();

    if(!$value['archive']== '1'){
        $delete=$value['id']."_D";
        $archive=$value['id']."_A";
        echo "
        <table>
         <tr>
          <th>Announcement</th>
          <th>Student category</th>
          <th>Posted on</th>
          <th>ACTION</th>
          
         </tr>
         <tr>
          <td>".$value['message']."</td>
          <td>".$value['student_category']."</td>
          <td>".$value['date']."</td>
          <td>
          <form  method='post'>
          <button type='submit' name='".$delete."'>DELETE</button>
          <button type='submit' name='".$archive."'>ARCHIVE</button>
         </form>
          </td>
        </tr>
       </table>";

       if(isset($_POST[$delete])){
         $active=true;

        $delete='UPDATE student_announcements SET active=? WHERE id=?';
        $stmt=$pdo->prepare($delete);
        
        $stmt->bindParam(1,$active);
        $stmt->bindParam(2,$value['id']);
        if($stmt->execute()){
          echo " <script>alert('Command Executed.');window.location.href='announcements.php';</script>";

        }
       }


       if(isset($_POST[$archive])){
        $active=true;

       $delete='UPDATE student_announcements SET archive=? WHERE id=?';
       $stmt=$pdo->prepare($delete);
       
       $stmt->bindParam(1,$active);
       $stmt->bindParam(2,$value['id']);
       if($stmt->execute()){
         echo "<script>alert('command Executed');window.location.href='announcements.php';</script>";
       }


      }
       
    }

    }

}

    else{ echo "No Announcements yet.";}
?>


</body>
</html>