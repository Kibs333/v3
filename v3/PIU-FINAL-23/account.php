<?php @require_once 'config.php';@require_once 'session_security.php';
  //registrar access to details

   
    if(isset($_GET['STUDENT_ADMISSION'])){
      // echo"echo gettt";
       $_SESSION['student_id']=$_GET['STUDENT_ADMISSION'];
// echo $_GET['STUDENT_ADMISSION'];
// var_dump($_SESSION['student_id']);
       $getDetails="SELECT * FROM students_form WHERE admission_number=?";
   
       $stmt=$pdo->prepare($getDetails);
       $stmt->bindParam(1, $_SESSION['student_id']);
       if($stmt->execute()){
         $data = $stmt->fetch(PDO::FETCH_ASSOC);

      //  var_dump($data);
      //  die();
         $_SESSION['student_acc_school']=$data["school"];}


      //  $_SESSION['full_name']
     
        $_SESSION['email']=$data['student_email'];

        $names=explode("@",$_SESSION['email']);
        
        $explodesnames=explode(".",$names[0]);

        $_SESSION['full_name']=$explodesnames[0].' '.$explodesnames[1];
        $data['admission_number']=$_GET['STUDENT_ADMISSION'];
        $_SESSION['student_id']=$data['id'];
        echo '
        
        <script>
        window.addEventListener("load",function(){

          document.getElementById("welcome").style.display = "none";
          document.getElementById("AccountDetails").style.display = "block";
          document.getElementById("emergecyDetails").style.display = "none";
          document.getElementById("notifications").style.display = "none";
  
          document.getElementById("log_link").style.display = "none";
          document.getElementById("notifications_link").style.display = "none";
          document.getElementById("nid").style.display = "none";
          

        });

        
        </script>
        
        ';
        // return;

  }

// students access to account
elseif($_SESSION['allowed']==true && isset($_SESSION['student_id']) && isset($_SESSION['full_name']))  {

  $getDetails="SELECT * FROM students_form WHERE id=?";
   
  $stmt=$pdo->prepare($getDetails);
  $stmt->bindParam(1, $_SESSION['student_id']);

  if($stmt->execute()){
     $data = $stmt->fetch(PDO::FETCH_ASSOC);
     $_SESSION['student_acc_school']=$data["school"];

    }}else{header('location:log-in.php');}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Student Details</title>
    <style>

        body{display:unset;}
        .container{margin: 0 auto;
    margin-bottom: 30px;}
    h1{font-size:14px;}
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
   
    }

    .sidebar {
      height: 100%;
      width: 100px;
      background-color: #673AB7;
      color: #ecf0f1;
      padding-top: 20px;
      position: fixed;
    }

    .sidebar a {
      text-decoration: none;
      color: #ecf0f1;
      padding: 15px 20px;
      display: block;
      font-size: 18px;
      transition: background-color 0.3s;
    }

    .sidebar a:hover {
      background-color: #34495e;
    }

    .content {
      margin-left: 80px;
      padding: 20px;
    }
    #AccountDetails{
        display:none;
    }









    /* Notification container styles */
    .notification {
      position: relative;
      padding: 16px;
      margin: 20px;
      background-color: #f8d7da; /* Light red background color */
      color: #721c24; /* Dark red text color */
      border: 1px solid #f5c6cb; /* Dark red border color */
      border-radius: 4px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    /* Date posted styles */
    .date-posted {
      font-size: 12px;
      color: #721c24; /* Dark red text color */
    }



  
    </style>
    
<link rel="stylesheet" href="staff\registrar\table.css">
</head>
<body>

<div class="sidebar">

  <a href="#notifications" id="notifications_link" ><i class="material-icons" title="notifications" id="notifications_" style="font-size: 24px;cursor: pointer;color: white;">notifications</i></a>
  <a href="#Account"  id="Account_link"><i class="material-icons" title="account information " id="account_circle" style="font-size: 24px;cursor: pointer;color: white;">account_circle</i></a>
  <a href="#Guardian"  id="Guardian_link"><i class="material-icons" title="Emergency Details" id="emergency_details" style="font-size: 24px;cursor: pointer;color: white;">contact_emergency</i></a>
  <a href="log-out.php"  id="log_link"><i class="material-icons" title="log Out" id="logOut" style="font-size: 24px;cursor: pointer;color: white;">logout</i></a>
  <!-- <a href="#services">Services</a>
  <a href="#contact">Contact</a> -->
</div>
<div id="content"class="content">
<div id="welcome"class="welcome">Welcome.Click a button on the left to get started.</div>

<div id="AccountDetails">
<div class="container">
    <form >
        <h1>ACCOUNT DETAILS</h1>
        <label for="name">Name</label>
        <input type="text" id="name" value="<?php echo $_SESSION['full_name'];?>" readonly>

        <label for="email">Email</label>
        <input type="text" id="email" value="<?php echo $_SESSION['email'];?>" readonly>

        <label for="Admission_number">Admission Number</label>
        <input type="text" id="Admission_number" value="<?php echo $data['admission_number'];?>" readonly>

        <label for="School">School</label>
        <input type="text" id="School" value="<?php echo $data['school'];?>" readonly>
        <label for="programme">programme</label>
        <input type="text" id="programme" value="<?php echo $data['programme'];?>" readonly>
        <label for="level_of_study">level of study</label>
        <input type="text" id="level_of_study" value="<?php echo $data['level_of_study'];?>" readonly>


        </form>
</div>
    <div class="container">


  <?php


$id_card_details="SELECT * FROM acc_details WHERE student_id=?";
    
$stmt=$pdo->prepare($id_card_details);
$stmt->bindParam(1, $_SESSION['student_id']);

if($stmt->execute()){
    $data_id_card = $stmt->fetch(PDO::FETCH_ASSOC);

}



if($data_id_card){


    echo '
    <form  id="nid">
        <h1>National ID Form</h1>

        <label for="nationalId">National ID Number:</label>
        <input type="number" id="nationalId" value="'.$data_id_card["nationalId"].'" readonly>

        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" value="'.$data_id_card["fullName"].'" readonly>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" value="'.$data_id_card["dob"].'" readonly>

        <label>Gender:</label>
        <input type="text" id="Gender" value="'.$data_id_card["Gender"].'" readonly>

        <label for="districtOfBirth">District Of Birth:</label>
        <input type="text" id="districtOfBirth" value="'.$data_id_card["districtOfBirth"].'" readonly>

        <label for="district">District:</label>
        <input type="text" id="district" value="'.$data_id_card["district"].'" readonly>

        <label for="location">Location:</label>
        <input type="text" id="location" value="'.$data_id_card["location"].'" readonly>

        <label for="placeOfIssue">Place of Issue:</label>
        <input type="text" id="placeOfIssue" value="'.$data_id_card["placeOfIssue"].'" readonly>

        <label for="division">Division:</label>
        <input type="text" id="division" value="'.$data_id_card["division"].'" readonly>

        <label for="subLocation">Sub Location:</label>
        <input type="text" id="subLocation" value="'.$data_id_card["subLocation"].'" readonly>

    </form>
    
    ';
}

?>

    </div>

</div>
<div id="emergecyDetails"class="emergecyDetails">




<?php
$getEmergencyDetails="SELECT * FROM student_emergency_details WHERE id=?";
    
$stmt=$pdo->prepare($getEmergencyDetails);
$stmt->bindParam(1, $_SESSION['student_id']);

if($stmt->execute()){
    $dataEmergecy = $stmt->fetch(PDO::FETCH_ASSOC);




if($dataEmergecy){

    echo "
    <table>
    <caption>Guardian Details</caption>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Tel</th>
    </tr>
    <tr>
        <td>".$dataEmergecy["guardian_name"]."</td>
        <td>".$dataEmergecy["guardian_email"]."</td>
        <td>".$dataEmergecy["guardian_tel"]."</td>
    </tr>
</table>";

}else{
  echo 'No Data Captured';
}






}


?>

</div>


<div id="notifications"class="announcement">
    <?php
    include "announcement_handler.php";
    ?>


</div>


</div>

<script>
    // Function to handle actions based on the hash
    function handleHashChange() {
      var hash = window.location.hash.substring(1); // Get the hash excluding the #
      
      // Perform actions based on the hash
      if (hash === "notifications") {

        document.getElementById("notifications").style.display = "block";
        document.getElementById("AccountDetails").style.display = "none";
        document.getElementById("emergecyDetails").style.display = "none";
        document.getElementById("welcome").style.display = "none";

      } else if (hash === "Account") {
         document.getElementById("AccountDetails").style.display = "block";
         document.getElementById("emergecyDetails").style.display = "none";
         document.getElementById("notifications").style.display = "none";
         document.getElementById("welcome").style.display = "none";

      } 

      
      else if (hash === "Guardian") {
         document.getElementById("AccountDetails").style.display = "none";
         document.getElementById("emergecyDetails").style.display = "block";
         document.getElementById("notifications").style.display = "none";
         document.getElementById("welcome").style.display = "none";

      } 
      
      else {
        document.getElementById("welcome").style.display = "block";
        document.getElementById("AccountDetails").style.display = "none";
        document.getElementById("emergecyDetails").style.display = "none";
        document.getElementById("notifications").style.display = "none";

      }
    }

    // Initial call to handle the hash when the page loads
    handleHashChange();

    // Attach the handleHashChange function to the hashchange event
    window.addEventListener("hashchange", handleHashChange);
  </script>
<script>
    var logOut = document.getElementById('logOut');
logOut.addEventListener('click', function() {
    window.location.href = "log-out.php";
});

</script>
</body>
</html>