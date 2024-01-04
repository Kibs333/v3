<?php

session_start();
if(!isset($_SESSION['cat-marks.php'])){
    header("location:../staff/staff.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPLOAD CAT MARKS</title>
    <link rel="stylesheet" href="resources/css/cat-marks.css">
</head>
<body>
 <div class="header">
  <img src="resources/img/cropped-PIU-ICON-512x512-2-1-192x192.png" alt="piu logo">
  <h1>UPLOAD CAT MARKS</h1>
 </div>
 <form action="upload-excel.php" method="post" enctype="multipart/form-data">
<div class="lec header" id="lec">
<p>Fill the details Below:</p>
    <input type="text" name="lec_name" id="" placeholder="LECTURER NAME" required><br>
    <input type="text" name="course_code" id="" placeholder="COURSE CODE" required><br>
    <input type="text" name="course_name" id="" placeholder="COURSE NAME" required><br>
    <input type="text" name="year" id="" min="2016" placeholder="YEAR" required><br>
    <input type="text" name="semester" id="" min="1"  max="6"placeholder="SEMESTER"required><br>
    <input type="text" name="yos" id="" min="1" max="6" placeholder="YEAR OF STUDY"required><br>
 <div class="upload">
        <label for="excelFile">Choose an Excel file:</label>
        <input type="file" name="excelFile" id="excelFile"  accept=".xlsx, .xls">
        <button type="submit" name="upload">Upload</button>
    </form>
</div>
</div>
</body>
</html>