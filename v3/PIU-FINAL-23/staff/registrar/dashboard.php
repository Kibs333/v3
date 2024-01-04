

<?php
require_once '../../session_security.php';
if(isset($_SESSION['registrar.php'])){
require_once '../../config.php';
require '../../functions.php';
$currentDateTime=timestamp();
$_SESSION['register-pdf']=false;
unset($_SESSION['student_id']); 
$displayQuery = "SELECT * FROM students_form WHERE registrar_approve IS NULL AND has_submitted_registration_form=1;";
$stmt = $pdo->prepare($displayQuery);
if($stmt->execute()){$data = $stmt->fetchALL(PDO::FETCH_ASSOC); }
else{die("Error student form did not relay data");}
if ($data){$number_of_requests = count($data);}else {$number_of_requests = 0;}}else{header("location:../staff/staff.php");}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/png" sizes="192x192" href="../../resources/img/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="../../resources/img/android-chrome-512x512.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../../resources/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../resources/img/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../resources/img/favicon-32x32.png">
    <link rel="icon" href="../../resources/img/favicon.ico" type="image/x-icon">
    <link rel="manifest" href="../../resources/img/site.webmanifest">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="table.css">
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
      margin-left: 180px;
      padding: 20px;
    }












    form {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 300px;
      text-align: center;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }

    input {
      width: 100%;
      padding: 8px;
      margin-bottom: 16px;
      box-sizing: border-box;
    }

    input[type="submit"],button  {
      background-color: #3498db;
      color: #fff;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #1a70a4;
    }

    input[type="datetime-local"] {
      margin-bottom: 16px;
    }

    ::placeholder {
      color: #a0a0a0;
    }



  </style>
  
<style>
    /* Style for textarea */
textarea {
  width: 100%;
  padding: 8px;
  margin-bottom: 16px;
  box-sizing: border-box;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical; /* Allow vertical resizing */
}

/* Style for select */
select {
  width: 100%;
  padding: 8px;
  margin-bottom: 16px;
  box-sizing: border-box;
  border: 1px solid #ccc;
  border-radius: 4px;
  appearance: none; /* Remove default dropdown arrow on some browsers */
  background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"><polygon points="0,0 4,4 8,0" fill="%23444444"/></svg>'); /* Add custom dropdown arrow */
  background-repeat: no-repeat;
  background-position: right 8px top 50%;
}

/* Hover effect for select */
select:hover {
  border-color: #666;
}

/* Focus effect for select */
select:focus {
  border-color: #3498db;
  outline: none;
}

/* Disable default styling on Firefox */
select::-moz-focus-inner {
  border: 0;
}
a{color:black;text-decoration:none;}
/* Style for the button */
button {
  background-color: #9C27B0;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
}

/* Style for the link inside the button */
button a {
  color: inherit; /* Inherit the color from the button */
  text-decoration: none;
}

/* Hover effect for the link inside the button */
button a:hover {
  text-decoration: underline;
}
.welcome{display:none;}
</style>
</head>
<body>

<div id="sidebar"class="sidebar">
  <a href="../../register1.4/registrar.php"target="_blank"> <i class="material-icons" title="Approve Students To register" id="Approve_Students_To_register" style="font-size: 24px;cursor: pointer;color: white;">verified</i></a>
  <a href="#studentSearch"><i class="material-icons" title="Student Search" id="person_search" style="font-size: 24px;cursor: pointer;color: white;">person_search</i></a>
  <a href="#setDeadline"><i class="material-icons" title="Set Deadline" id="timer" style="font-size: 24px;cursor: pointer;color: white;">timer</i></a>
  <a href="#setAnnouncement"><i class="material-icons" title="Make Announcement" id="make_Announcement" style="font-size: 24px;cursor: pointer;color: white;">campaign</i></a>
  <a href="#getReports"><i class="material-icons" title="Read Reports" id="reportFiles" style="font-size: 24px;cursor: pointer;color: white;">description</i></a>
  <!-- <a href="#uploadFile"><i class="material-icons" title="Upload File" id="files" style="font-size: 24px;cursor: pointer;color: white;">uploadfile</i></a> -->
  <a href="../../log-out.php"><i class="material-icons" title="log Out" id="logOut" style="font-size: 24px;cursor: pointer;color: white;">logout</i></a>

</div>

<div class="content" id="content">

<div id="welcome"class="welcome">Welcome.Click a button on the left to get started.</div>

<div class="search" id="search">
    <h1>Student Search</h1>
    <h2>Search student registration data</h2>
 <form action="student_status.php" method="get">
  <input type="text" name="STUDENT_ADMISSION"  placeholder="Enter Admission number"><br>
  <input type="submit" value="Submit">
 </form>
 <h2>Search Student Info </h2>
 <form action="../../account.php" method="get">
  <input type="text" name="STUDENT_ADMISSION"  placeholder="Enter Admission number"><br>
  <input type="submit" value="Submit">
 </form>
</div>






<div class="setdeadline" id="setDeadline">

<!-- current deadline -->
<h1>Set Deadline</h1>
 <form action="setDeadline.php" method="post">
  <input type="datetime-local" name="DEADLINE" id="">
  <input type="submit" value="Submit">
</form>

</div>

<div class="makeAnnouncement" id="makeAnnouncement">

 <h1>Announcements</h1>

 <h2>Make Announcement</h2>

 <form action="announcements/make_announcement.php" method="post">


<textarea name="announcement" id="" cols="30" rows="10">


</textarea>


<select name="student_category" id="">
<option value="ALL_COHORTS">ALL COHORTS</option>
<option value="1st_yr">First Years</option>
<option value="2nd_yr">Second Years</option>
<option value="3rd_yr">Third Years</option>
<option value="4th_yr">Fourth Years</option>
</select>
<select name="student_school" id="">
<option value="ALL_SCHOOLS">ALL SCHOOLS</option>
<option value="SCIT">SCIT</option>
<option value="SBM">SBM</option>
<option value="SDSS">SDSS</option>
<option value="SEDU">SEDU</option>
<option value="SAMS">SAMS</option>

</select>

<input type="submit" value="POST ANNOUNCEMENT">
</form>

<button type="button" style="margin-top:30px;    outline: none;
    border: none;">
<a href="announcements/announcements.php">VIEW ALL ANNOUNCEMENTS</a>
</button>


</div>


<div class="dataReports" id="dataReports">
  <h1>DATA</h1>
<button type="button" style="margin-top:30px;    outline: none;
    border: none;">
<a href="../../register1.4/reg_data.php">VIEW REGISTRATION DATA</a>
<?php $_SESSION['reg_data.php']=true;?>
</button>
<h1>Students Rejected By Finance</h1>
    <?php  include 'data.php' ?>
    
</div>

<!-- <div id="upload_files" class="upload_files">
<h1>Upload courses on offer-JAN-APR 2024</h1>

</div> -->



</div>

<script>
    // Function to handle actions based on the hash
    function handleHashChange() {
      var hash = window.location.hash.substring(1);
      
      if (hash === "studentSearch") {
          document.getElementById("search").style.display = "block";
          document.getElementById("setDeadline").style.display = "none";
          document.getElementById("makeAnnouncement").style.display = "none";
          document.getElementById("dataReports").style.display = "none";
        //   document.getElementById("upload_files").style.display = "none";
        document.getElementById("welcome").style.display = "none";
      } else if (hash === "setDeadline") {
        document.getElementById("setDeadline").style.display = "block";
        document.getElementById("search").style.display = "none";
        document.getElementById("makeAnnouncement").style.display = "none";
        document.getElementById("dataReports").style.display = "none";
        // document.getElementById("upload_files").style.display = "none";
        document.getElementById("welcome").style.display = "none";
      } 
      else if (hash === "getReports") {

        document.getElementById("dataReports").style.display = "block";
        document.getElementById("setDeadline").style.display = "none";
        document.getElementById("search").style.display = "none";
        document.getElementById("makeAnnouncement").style.display = "none";
        // document.getElementById("upload_files").style.display = "none";
        document.getElementById("welcome").style.display = "none";
 
      } 
    //   else if (hash === "uploadFile") {
        
    //     document.getElementById("upload_files").style.display = "block";
    //     document.getElementById("setDeadline").style.display = "none";
    //     document.getElementById("search").style.display = "none";
    //     document.getElementById("makeAnnouncement").style.display = "none";
    //     document.getElementById("dataReports").style.display = "none";

    //   } 
      
      else if (hash === "setAnnouncement") {
        document.getElementById("dataReports").style.display = "none";
        document.getElementById("makeAnnouncement").style.display = "block";
        document.getElementById("setDeadline").style.display = "none";
        document.getElementById("search").style.display = "none";
        // document.getElementById("upload_files").style.display = "none";
        document.getElementById("welcome").style.display = "none";

      } 
      
      else {
        document.getElementById("welcome").style.display = "block";
  
        document.getElementById("makeAnnouncement").style.display = "none";
        document.getElementById("search").style.display = "none";
        document.getElementById("setDeadline").style.display = "none";
        document.getElementById("dataReports").style.display = "none";
        document.getElementById("dataReports").style.display = "none";
        // document.getElementById("upload_files").style.display = "none";
      }
    }

    handleHashChange();

    // Attach the handleHashChange function to the hashchange event
    window.addEventListener("hashchange", handleHashChange);
  </script>

</body>
</html>