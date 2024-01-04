<?php

//include 'https://portal.sicklywall.com/session_security.php';
include '../../session_security.php';
if(!isset($_SESSION['finance.php'])){
//echo 'alert';
  //header("location:https://portal.sicklywall.com");

}

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
  <link rel="stylesheet" href="../table.css">
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
  <a href="../../register1.4/finance.php"target="_blank"> <i class="material-icons" title="Approve Students To register" id="Approve_Students_To_register" style="font-size: 24px;cursor: pointer;color: white;">verified</i></a>
  <a href="#studentSearch"><i class="material-icons" title="Student Search" id="person_search" style="font-size: 24px;cursor: pointer;color: white;">person_search</i></a>
  <a href="#auto_approve"><i class="material-icons" title="Auto Approve" id="autoApprove" style="font-size: 24px;cursor: pointer;color: white;">checklist</i></a>

  <a href="../../log-out.php"><i class="material-icons" title="log Out" id="logOut" style="font-size: 24px;cursor: pointer;color: white;">logout</i></a>

</div>

<div class="content" id="content">
<div id="welcome"class="welcome">Welcome.Click a button on the left to get started.</div>
<!-- studentSearch -->

<div class="studentSearch">
 <div class="search" id="search">
  <h1>Student Search</h1>
  <form action="finance_studentSearch.php" method="get">
   <input type="text" name="STUDENT_ADMISSION"  placeholder="Enter Admission number"><br>
   <input type="submit" value="Submit">
  </form>

 </div>
</div>
<div class="autoapprove" id="fAutoApprove">


<h1>Auto Approve List</h1>
<sub>
<!-- **Can Only Be Submitted Once** <br> -->
**Column   <b> Admission Number</b>    Must be Present**
</sub><br>

<form action="read_excel.php" method="POST"enctype="multipart/form-data" >
    <br>

<input type="file" name="excelFile" id="">
<input type="submit" value="submit">
</form>
</div>

</div>
<script>
    // Function to handle actions based on the hash
    function handleHashChange() {
      var hash = window.location.hash.substring(1);
      
      if (hash === "studentSearch") {
          document.getElementById("search").style.display = "block";
          document.getElementById("welcome").style.display = "none";
          document.getElementById("fAutoApprove").style.display = "none";
          
       } 
    else if (hash === "auto_approve") {
        document.getElementById("search").style.display = "none";
        document.getElementById("fAutoApprove").style.display = "block";
        document.getElementById("welcome").style.display = "none";
      } 
  
      
      else {
        document.getElementById("welcome").style.display = "block";
        document.getElementById("search").style.display = "none";
        document.getElementById("fAutoApprove").style.display = "none";


      }
    }

    handleHashChange();

    // Attach the handleHashChange function to the hashchange event
    window.addEventListener("hashchange", handleHashChange);
  </script>
</body>
</html>