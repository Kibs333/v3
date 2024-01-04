<?php 
session_start();

if(!isset($_SESSION['COURSE-EVAL-auth'])){
    
    
    header("location:https://portal.sicklywall.com/v2/PIU-FINAL-23/");
}
include "config.php";
$none="none";
$select ="SELECT * FROM submission_form" ;
$stmt = $pdo->prepare($select);
$stmt->execute();
$tables = $stmt->fetchALL(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Evaluation Form</title>
    <style>
    .grid-1{background:#9C27B0;margin-bottom:20px;}
    .grid-1 .out{ max-width:10%;}
    table {border:1px solid black;border-collapse:collapse;margin:10px;width: -webkit-fill-available;;max-width:100%;}
    tr:nth-child(odd){ background-color: bisque;}
    th,td{border:1px solid black;}
    .heading h1{text-align: center;}
    button{    padding: 10px;
    background: blueviolet;
    width: 80%;
    text-align: center;
    border-radius: 20px;
    margin: 0 auto;
    display: flex;
    justify-content: center;
    align-items: center;
    outline: none;
    border: none;}
    </style>
</head>
<body>
 <div class="container"> 
  <div class="grid-1">
   <img class="out" src="resources/img/PIU-LOGO-WHITE.png" alt="pioneer international university"></div>    
   <div class="heading"><h1>Course Evaluation Data</h1></div>
   <form action="data.php" method="get">  
   <div class="sort">
   <div class="sortbyunitname">
    
   <p style="text-align: center;">Available Evaluation Forms

   </p> 

    <?php 
if($tables){

foreach($tables as $x){
    echo  
    "<table>
        <tr>
            <th>UnitName</th>
            <th>UnitCode</th>
            <th>Lecturer</th>
            <th>Semester</th>
            <th>YearOfStudy</th>
            <th>Year</th>
            <th>#</th>
        </tr>
        <tr>
            <td>". $x['UnitName']."</td>
            <td>". $x['unitcode']."</td>
            <td>". $x['lecturer_name']."</td>
            <td>". $x['semester']."</td>
            <td>". $x['yos']."</td>
            <td>". $x['year']."</td>
            <td><button type='submit' name='table_name' value='".$x['table_name']."'>View</button></td>
        </tr>
    </table>";

}
    
}
else{die("No Evaluation forms filled yet.");}
?>
   </div>
   </div>
   </form>
   
</body>
</html>