<?php

session_start();
if(!isset($_SESSION['data.php'])){
    //echo 'alert';
      header("location:https://portal.sicklywall.com");
    
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download data by school</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form action="s.php" method="post">
<!-- **this will make an excel file.** <br>
** the first column is the names and the second column is admission number** <br> -->
<h6>Generate Excel form</h6>
<select name="School" id="School" required>
        <option  value="" disabled selected>Select your school</option>
         <option value="SBM">SBM</option>
         <option value="SICT">SICT</option>
         <option value="SDSS">SDSS</option>
         <option value="SEDU">SEDU</option>
         <option value="SAMS">SAMS</option>
</select>

<select name="yos" id="yos" required>
        <option  value="" disabled selected>Select the year of study</option>
         <option value="1.2">1.2</option>
         <option value="2.1">2.1</option>
         <option value="3.1">3.1</option>
         <option value="3.2">3.2</option>
         <option value="4.1">4.1</option>
         <option value="4.2">4.2</option>
</select>
<select name="prog" id="prog">
         <option value="" disabled selected >Select your programme</option>
         <option value="DBM">DBM</option>
         <option value="DIT">DIT</option>
         <option value="DPGM">DPGM</option>
         <option value="DBIT">DBIT</option>
         <option value="BCOM">BCOM</option>

<option value="BA-IR">BA-IR</option>
<option value="DIR">DIR</option>
<option value="DMTL">DMTL</option>
<option value="DSWCD">DSWCD</option>
<option value="DAM">DAM</option>
<option value="BSIT">BSIT</option>
<option value="BED-A">BED-A</option>

</select>
<select name="LOS" id="LOS">
        <option value="" disabled selected>Select your level of study</option>
        <option value="Certificate">Certificate</option>
        <option value="Diploma">Diploma</option>
        <option value="Degree">Degree</option>
        <option value="Masters">Masters</option>
        </select>

<button type="submit">Generate File</button>

    </form>
</body>
</html>